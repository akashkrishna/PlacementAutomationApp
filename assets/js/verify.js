var expanded = false;
function showCheckboxes() {
var checkboxes = document.getElementById("checkboxes");
if (!expanded) {
  checkboxes.style.display = "block";
  expanded = true;
} else {
  checkboxes.style.display = "none";
  expanded = false;
}}

var exp = false;
function scb() {
var cb = document.getElementById("cb");
if (!exp) {
  cb.style.display = "block";
  exp = true;
} else {
  cb.style.display = "none";
  exp = false;
}}

function verify() {
var ug = $("#ug").is(":checked");
var pg = $("#pg").is(":checked");
var phd = $("#phd").is(":checked");
  if (!ug && !pg && !phd ) {
    swal("Select Degree!", "Please select which degree students are required", "error");
      return false; }

var cs = $("#cs").is(":checked");
var m = $("#m").is(":checked");
var s = $("#s").is(":checked");
var p = $("#p").is(":checked");
var ch = $("#ch").is(":checked");
var cm = $("#cm").is(":checked");
var ba = $("#ba").is(":checked");
    if (!cs && !m && !s && !p && !ch && !cm && !ba) {
      swal("Select Branch!", "Please select which branch students are required", "error");
        return false; }

    if (document.app.rd.value<=document.app.ld.value) {
      swal("Invalid Date!", "Recruitment Date must be after the Registration date", "error");
        return false; }
}
