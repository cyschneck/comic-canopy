extends GridContainer
@onready var test_row: GridContainer = $"."

func _on_comic_page_link_button_pressed() -> void:
	print(test_row.name)
