var name = 'opengraphtags';
if(typeof Prestashop == 'undefined')
	var Prestashop = {};
if(typeof Prestashop.opengraphtags == 'undefined')
	Prestashop.opengraphtags = {};
if(typeof Prestashop.opengraphtags.backend == 'undefined')
	Prestashop.opengraphtags.backend = {};
if(typeof Prestashop.opengraphtags.backend.configure == 'undefined')
	Prestashop.opengraphtags.backend.configure = {};

Prestashop.opengraphtags.backend.configure.script = {};
Prestashop.opengraphtags.backend.ajaxUrl = '../modules/'+ name +'/ajax.php';
Prestashop.opengraphtags.backend.dataType = 'json';

$(document).ready(function() {
  $("").click();
});

// -----------------------------
// ----- EVENTS LISTENERS ------
// -----------------------------
function onClickListener(e) {
	e.preventDefault();

	var element = $(this);
}

// -----------------------------
// --------- FUNCTIONS ---------
// -----------------------------

Prestashop.opengraphtags.backend.configure.fct = function(variable, callback) {
	
	return callback;
}