<?php 
/*
* Disable WordPress Search
*/
function true_search_turn_off($q, $e = true)
{
	if (is_search()) {
		$q->is_search = false;
		$q->query_vars[s] = false;
		$q->query[s] = false;
		if ($e == true) {
			// вешаем страницу с ошибкой 404
			$q->is_404 = true;
		}
	}
}
add_action('parse_query', 'true_search_turn_off');
add_filter('get_search_form', '__return_false');
