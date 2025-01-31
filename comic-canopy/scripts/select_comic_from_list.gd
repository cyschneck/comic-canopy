extends VBoxContainer

func _ready() -> void:
	print("running setup")
	for button in get_tree().get_nodes_in_group("comic_main_select"):
		#button.connect("pressed", Callable(self, "_on_comic_page_link_button_pressed").bind(button))
		#button.connect("pressed", self, _on_comic_page_link_button_pressed, [button])
		button.pressed.connect(_on_comic_page_link_button_pressed.bind(button))

func _on_comic_page_link_button_pressed(selected_button) -> void:
	print("button pressed")
	print(selected_button.get_parent().get_parent().get_name())
