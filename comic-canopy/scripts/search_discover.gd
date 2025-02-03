extends Control

@onready var input_line: LineEdit = %InputLine
@onready var discover_v_box_container: VBoxContainer = $DiscoverScrollContainer/DiscoverVBoxContainer
@onready var loading_image: TextureRect = $LoadingImage
@onready var popup_panel: PanelContainer = %PopupPanel
const TEST_COMIC_ROW_PREFAB = preload("res://scenes/test_comic_row_prefab.tscn")

var _BASE_URL = ''
var _ARCHIVE_URL = ''
var popup_is_yes = false

func _ready() -> void:
	discover_v_box_container.visible = false
	loading_image.visible = false
	popup_panel.visible = false

func _on_line_edit_text_submitted(url_input: String) -> void:
	# triggered when enter pressed
	input_line.text = "" # remove input after submitted
	loading_image.visible = true
	discover_v_box_container.visible = false # set container false for each new search
	print(url_input)

	if "http://" not in url_input: url_input = "http://" + url_input
	if url_input[-1] == "/": url_input = url_input.left(url_input.length() - 1) # remove trailing /
	_BASE_URL = url_input
	# check base URL
	check_url(url_input)

func check_url(input_url: String) -> void:
	var http_request = HTTPRequest.new()
	add_child(http_request)
	http_request.request_completed.connect(_on_request_completed)
	http_request.request(input_url)

func _on_request_completed(result, response_code, headers, body) -> void:
	var html = body.get_string_from_utf8()
	if response_code == 200:
		var url = _BASE_URL
		if "archive" in html: url += "/archive"
		if "archives" in html: url += "/archives"
		if "archive" not in html and "archives" not in html:
			print("Not archive link found")
		_ARCHIVE_URL = url
		print("VALID url")
		loading_image.visible = false
		popup_panel.visible = true
	else:
		loading_image.visible = false
		print("invalid URL")

func popup_check_archive_link()-> void:
	popup_panel.visible = false
	if popup_is_yes == true:
		loading_image.visible = true
		populate_archive_link(_ARCHIVE_URL)
	else:
		loading_image.visible = true
		populate_archive_link(_ARCHIVE_URL)

func _on_yes_button_pressed() -> void:
	popup_check_archive_link()
	popup_is_yes = true

func _on_no_button_pressed() -> void:
	popup_check_archive_link()
	popup_is_yes = false

func populate_archive_link(url: String) -> void:
	var http_request = HTTPRequest.new()
	add_child(http_request)
	http_request.request_completed.connect(_on_request_archive_completed)
	http_request.request(url)
	
func _on_request_archive_completed(result, response_code, headers, body) -> void:
	var html = body.get_string_from_utf8()
	var body_html = html.split("\n")
	
	for child in discover_v_box_container.get_children():
		child.queue_free()

	for line in body_html:
		if "a href=" in line:
			print(line)
			var discover_row = TEST_COMIC_ROW_PREFAB.instantiate()
			discover_row.name = line
			discover_row.get_child(1).text = line
			# edit link button text
			#discover_row.get_child(2).uri = "https://xkcd.com/3043/"
			discover_v_box_container.add_child(discover_row)

	loading_image.visible = false
	discover_v_box_container.visible = true
