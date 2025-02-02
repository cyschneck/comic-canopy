extends Control

var comic_data = {}

func _ready() -> void:
	var file = FileAccess.open("res://data/example_data.csv", FileAccess.READ)
	var i = 0
	while !file.eof_reached():
		var csv_row = file.get_csv_line(",")
		comic_data[i] = csv_row
		i += 1
	print(comic_data)
