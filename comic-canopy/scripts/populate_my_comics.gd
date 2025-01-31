extends Control

@onready var v_box_container: VBoxContainer = %VBoxContainer
const TEST_MY_COMICS_GRID_CONTAINER = preload("res://scenes/test_my_comics_grid_container.tscn")

var comic_archive = ["sci-fi comic",
					"cat comic",
					"slice of life",
					"fantasy dragons",
					"fantasy magic",
					"musical comic",
					"arty comic",
					"test comic",
					"mystery comic",
					"funny comic"]
	# testing random number generator
var rng = RandomNumberGenerator.new()

func _ready() -> void:
	# remove testing rows
	for child in v_box_container.get_children():
		child.queue_free()
	
	# add comic rows for each comic saved
	var i = 0
	for comic in comic_archive:
		# add new "test_row" to comics grid
		var comic_row = TEST_MY_COMICS_GRID_CONTAINER.instantiate()
		comic_row.name = "comic_" + str(i) # make each row with a callable name
		i += 1
		# edit RichTextLabel with specific comic info
		var comic_name = "\n[b]" + comic.capitalize() + "[/b]"
		var artist_writer = "[i]Author " + "[/i]"
		var last_read = "Last read " + str(rng.randi_range(2, 365)) + " days"
		comic_row.get_child(1).text = comic_name + "\n" + artist_writer + "\n" + last_read
		#comic_row.get_child(1).get_child(0).uri = "https://xkcd.com/3043/"
		# edit link button text
		comic_row.get_child(2).get_child(0).text = "Continue #" +  str(rng.randi_range(1, 100))
		comic_row.get_child(2).uri = "https://phdcomics.com/"
		v_box_container.add_child(comic_row)
