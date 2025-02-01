extends GridContainer

# reference My Comic row being used by this script
@onready var test_row: GridContainer = $"."
const TEST_SPECIFIC_COMICS_GRID_CONTAINER = preload("res://scenes/test_specific_comics_grid_container.tscn")

# testing random number generator
var rng = RandomNumberGenerator.new()
var comic_pages = range(1, rng.randi_range(5, 20))

func _on_comic_page_link_button_pressed() -> void:
	#print(test_row.name)
	var comic_header = get_node("/root/menu/MarginContainer/MainMiddle/MyComics/MyComicsHeader")
	var my_comics_scroll_container = get_node("/root/menu/MarginContainer/MainMiddle/MyComics/MyComicsScrollContainer")
	var selected_comics_scroll_container = get_node("/root/menu/MarginContainer/MainMiddle/MyComics/SelectedComicsScrollContainer")
	my_comics_scroll_container.visible = false
	selected_comics_scroll_container.visible = true

	# update header with comic name
	var full_comic_name = test_row.name
	if full_comic_name.length() > 20: # only display the first 20 characters of a long title
		full_comic_name = full_comic_name.left(20) + "..."
	comic_header.text = full_comic_name
	
	# remove testing rows from selected comics
	for child in selected_comics_scroll_container.get_child(0).get_children():
		child.queue_free()

	# add comic rows for each comic saved
	for page_num in comic_pages:
		# add new "test_row" to comics grid
		var page_row = TEST_SPECIFIC_COMICS_GRID_CONTAINER.instantiate()
		page_row.name = str(page_num)

		# edit RichTextLabel with specific comic info
		var page_number = "\n[b]Page " + str(page_num) + "[/b]"
		var date_published = "January 31, 2024"
		page_row.get_child(1).text = page_number + "\n" + date_published

		# edit link button text
		page_row.get_child(2).text = "Continue #" +  str(page_num)
		#page_row.get_child(2).uri = "https://xkcd.com/3043/"
		selected_comics_scroll_container.get_child(0).add_child(page_row)
