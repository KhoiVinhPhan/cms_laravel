$(document).ready(function(){
	
});

function insertCategoryArr() {
	$("#categorys > option").each(function() {
		if (this.selected) {
			//alert(this.text + ' ' + this.value);
			var len = $( "#indexCategoryChoie > tbody > tr" ).length + 1;
			var html = 
				'<tr>'
				+	'<td>'+len+'</td>'
				+	'<td>'+this.text+'</td>'
				+	'<td>Xóa</td>'
				+'</tr>';
			$( "#indexCategoryChoie" ).append(html);
		}
	});
}