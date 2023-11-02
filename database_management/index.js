function rowClicked(row) {
  console.log('Clicked ', parseInt(row.id));
  window.location.replace('./index.php?prod_id=' + parseInt(row.id));
}
