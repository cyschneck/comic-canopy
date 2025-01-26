extends Node

@onready var my_comics_tab: PanelContainer = %MyComicsTab
@onready var add_new_tab: PanelContainer = %AddNewTab
@onready var settings_tab: PanelContainer = %SettingsTab

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

func on_tab_pressed(button) -> void:
	for other_button in button.get_button_group().get_buttons():
			# set all buttons to WHITE
			other_button.modulate = Color.WHITE
	# set selected button to BLACK
	button.modulate = Color.BLACK # selected button set color

	# set ALL panels visible to false
	my_comics_tab.visible = false
	add_new_tab.visible = false
	settings_tab.visible = false
	
	# set seleted button's panel to true
	match button.name:
		"MyComicsButton": my_comics_tab.visible = true
		"AddNewButton": add_new_tab.visible = true
		"SettingsButton": settings_tab.visible = true
