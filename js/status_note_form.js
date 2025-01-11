// for status
function editStatus(id) {
  document.getElementById("id_lib").value = id;
  document.getElementById("status").value =
    document.getElementById("id_biblio").value;

  document.getElementById("statusModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("statusModal").classList.add("hidden");
}

// for notation
function editNotation(id) {
  document.getElementById("id_jeu").value = id;
  document.getElementById("nota").value =
    document.getElementById("id_libra").value;

  document.getElementById("notationModal").classList.remove("hidden");
}

function closeModalN() {
  document.getElementById("notationModal").classList.add("hidden");
}

// for status
function editTime(id) {
  document.getElementById("id_jeu_t").value = id;
  document.getElementById("time").value =
    document.getElementById("id_biblio_t").value;

  document.getElementById("timeModal").classList.remove("hidden");
}

function closeModalT() {
  document.getElementById("timeModal").classList.add("hidden");
}
