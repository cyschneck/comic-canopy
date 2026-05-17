function searchComicsByName() {
  // search comics in recommendation based on comic name
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("comicName");
  filter = input.value.toUpperCase();
  table = document.getElementById("recommendation-table");
  tr = table.getElementsByTagName("tr");

  // Loop through all rows and hide rows that don't match quer
  for (i = 0; i < tr.length; i++) {
    comic_name_h3 = tr[i].getElementsByTagName("h3")[0];
    if (comic_name_h3) {
      txtValue = comic_name_h3.textContent || comic_name_h3.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}