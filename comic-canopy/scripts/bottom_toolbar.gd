extends Node

# Control nodes for three main sections of menu
@onready var my_comics: Control = %MyComics
@onready var add_new: Control = %AddNew
@onready var settings: Control = %Settings

# access each tab button of the menu
@onready var my_comics_button: TextureButton = %MyComicsButton
@onready var add_new_button: TextureButton = %AddNewButton
@onready var settings_button: TextureButton = %SettingsButton

func _ready() -> void:
	setup_functions()
	on_tab_pressed(my_comics_button) # start on My Comics page
	
func take_screenshot():
	var date = Time.get_date_string_from_system().replace(".","_") 
	var time :String = Time.get_time_string_from_system().replace(":","")
	var screenshot_path = "res://assets/screenshots/screenshot_" + date+ "_" + time + ".jpg"
	var image = get_viewport().get_texture().get_image()
	image.save_jpg(screenshot_path)
	
func setup_functions() -> void:
	var touch_areas = get_tree().get_nodes_in_group("touch_screen_button")
	for area in touch_areas:
		area.connect("pressed", Callable(self, "on_touched_area_pressed").bind(area))

func on_touched_area_pressed(TouchArea) -> void:
	match TouchArea.name:
		"my_comic_touch": on_tab_pressed(my_comics_button)
		"add_new_touch": on_tab_pressed(add_new_button)
		"settings_touch": on_tab_pressed(settings_button)

func on_tab_pressed(selected_button) -> void:
	# unselected buttons set to DIM_GRAY
	my_comics_button.modulate = Color.DIM_GRAY
	add_new_button.modulate = Color.DIM_GRAY
	settings_button.modulate = Color.DIM_GRAY

	# select button to ORANGE
	selected_button.modulate = Color("#fb8b01")

	# set ALL headers visibilty to false
	my_comics.visible = false
	add_new.visible = false
	settings.visible = false
	
	# set seleted button's header to true
	match selected_button.name:
		"MyComicsButton": 
			my_comics.visible = true
			my_comics.get_child(0).text = "My Comics"
			my_comics.get_child(1).visible = true
			my_comics.get_child(2).visible = false
			#take_screenshot()
		"AddNewButton": 
			add_new.visible = true
			#take_screenshot()
		"SettingsButton": 
			settings.visible = true
			#take_screenshot()
