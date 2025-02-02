extends Control

@onready var input_line: LineEdit = %InputLine
const TEST_MY_COMICS_GRID_CONTAINER = preload("res://scenes/test_my_comics_grid_container.tscn")
@onready var discover_v_box_container: VBoxContainer = $DiscoverScrollContainer/DiscoverVBoxContainer

var _BASE_URL = ''

func _ready() -> void:
	discover_v_box_container.visible = false

func set_base_url(url_input: String) -> void:
	_BASE_URL = url_input

func get_base_url() -> String:
	return _BASE_URL

func _on_line_edit_text_submitted(url_input: String) -> void:
	# triggered when enter pressed
	input_line.text = "" # remove input after submitted
	print(url_input)
	if "http://" not in url_input: url_input = "http://" + url_input
	if url_input[-1] == "/": url_input = url_input.left(url_input.length() - 1) # remove trailing /
	set_base_url(url_input)
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
		var url = get_base_url()
		if "archive" in html: url += "/archive"
		if "archives" in html: url += "/archives"
		if "archive" not in html and "archives" not in html:
			print("Not archive link found")
		print(url)
		print("VALID url")
		var http_request = HTTPRequest.new()
		add_child(http_request)
		http_request.request_completed.connect(_on_request_archive_completed)
		http_request.request(url)
	else:
		print("invalid URL")

func _on_request_archive_completed(result, response_code, headers, body) -> void:
	var html = body.get_string_from_utf8()
	var body_html = html.split("\n")
	
	for child in discover_v_box_container.get_children():
		child.queue_free()

	for line in body_html:
		if "a href=" in line:
			var discover_row = TEST_MY_COMICS_GRID_CONTAINER.instantiate()
			discover_row.name = line
			discover_row.get_child(1).text = line
			# edit link button text
			#discover_row.get_child(2).uri = "https://xkcd.com/3043/"
			discover_v_box_container.visible = true
			discover_v_box_container.add_child(discover_row)
	print("done")
