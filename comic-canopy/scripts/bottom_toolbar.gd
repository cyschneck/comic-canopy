extends Node

@onready var my_comics: Control = %MyComics
@onready var add_new: Control = %AddNew
@onready var settings: Control = %Settings
@onready var specific_comics_scroll_container: ScrollContainer = %SpecificComicsScrollContainer

@onready var my_comics_button: TextureButton = %MyComicsButton
@onready var add_new_button: TextureButton = %AddNewButton
@onready var settings_button: TextureButton = %SettingsButton

func _ready() -> void:
	setup_functions()
	on_tab_pressed(my_comics_button)
	
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
	# unselected buttons set to BLACK
	my_comics_button.modulate = Color.BLACK
	add_new_button.modulate = Color.BLACK
	settings_button.modulate = Color.BLACK

	# select button to WHITE
	selected_button.modulate = Color.WHITE

	# set ALL headers visibilty to false
	my_comics.visible = false
	specific_comics_scroll_container.visible = false
	add_new.visible = false
	settings.visible = false
	
	# set seleted button's header to true
	match selected_button.name:
		"MyComicsButton": my_comics.visible = true
		"AddNewButton": add_new.visible = true
		"SettingsButton": settings.visible = true
