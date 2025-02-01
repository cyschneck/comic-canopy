extends Control

@onready var my_comics_v_box_container: VBoxContainer = %MyComicsVBoxContainer
const TEST_MY_COMICS_GRID_CONTAINER = preload("res://scenes/test_my_comics_grid_container.tscn")

var comic_archive = ["sci-fi comic",
					"cat comic",
					"slice of life comic",
					"fantasy dragons comic",
					"fantasy magic comic",
					"red comic comic",
					"arty comic",
					"horror comic",
					"murder mystery comic",
					"sad comic",
					"In the beginning, the universe was created. This has made a lot of people very angry and been widely regarded as a bad move.",
					"funny comic"]

# testing random number generator
var rng = RandomNumberGenerator.new()

func _ready() -> void:
	# remove testing rows
	for child in my_comics_v_box_container.get_children():
		child.queue_free()
	
	# add comic rows for each comic saved
	for comic_name in comic_archive:
		# add new "test_row" to comics grid
		var comic_row = TEST_MY_COMICS_GRID_CONTAINER.instantiate()
		comic_row.name = comic_name.capitalize()

		# edit RichTextLabel with specific comic info
		var full_comic_name = str(comic_name)
		if full_comic_name.length() > 65: # only display the first X characters of a long title
			full_comic_name = full_comic_name.left(65) + "..."
		var display_name = "\n[b]" + str(full_comic_name.capitalize()) + "[/b]"
		var artist_writer = "[i]Author " + "[/i]"
		var last_read = "Last read " + str(rng.randi_range(2, 365)) + " days"
		comic_row.get_child(1).text = display_name + "\n" + artist_writer + "\n" + last_read + "\n"

		# edit link button text
		comic_row.get_child(2).get_child(0).text = "Continue #" +  str(rng.randi_range(1, 100))
		comic_row.get_child(2).uri = "https://xkcd.com/3043/"
		my_comics_v_box_container.add_child(comic_row)
