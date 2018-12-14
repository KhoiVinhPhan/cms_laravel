//add category
function insertCategoryArr() {
	$("#categorys > option").each(function() {
		if (this.selected) {
			var len = $( "#indexCategoryChoie > tbody > tr" ).length + 1;

			var html = 
				'<tr id="group-category">'
				+	'<td class="stt">'+len+'</td>'
				+	'<td>'+this.text
				+		'<input hidden type="input" name="categoryId[]" class="id-category" value="'+this.value+'">'
				+	'</td>'
				+	'<td><input type="button" class="button-delete btn btn-danger btn-sm" onclick="deleteCategory()" value="Xóa"></td>'
				+'</tr>';
			$( "#indexCategoryChoie" ).append(html);
			$(this).attr('disabled','disabled');

			$( "#group-category" ).each(function() {
				$(this).find("input.id-category").attr('name', 'categoryId[]');
			} );
		}
	});
}

//add all categories
function insertAllCategoryArr(){
	$("#categorys > option").each(function() {
		if (!this.disabled) {
			var len = $( "#indexCategoryChoie > tbody > tr" ).length + 1;

			var html = 
				'<tr id="group-category">'
				+	'<td class="stt">'+len+'</td>'
				+	'<td>'+this.text
				+		'<input hidden type="input" name="categoryId[]" class="id-category" value="'+this.value+'">'
				+	'</td>'
				+	'<td><input type="button" class="button-delete btn btn-danger btn-sm" onclick="deleteCategory()" value="Xóa"></td>'
				+'</tr>';
			$( "#indexCategoryChoie" ).append(html);
			$(this).attr('disabled','disabled');

			$( "#group-category" ).each(function() {
				$(this).find("input.id-category").attr('name', 'categoryId[]');
			} );
		}
	});
}

//delete category
function deleteCategory() {
	$( "#indexCategoryChoie" ).on("click", ".button-delete", function(){
		$(this).closest("tr#group-category").remove();
		var value = $(this).closest("tr#group-category").find("input.id-category").val();
		$( "#categorys > option" ).each(function(){
			if (this.value == value) {
				$(this).removeAttr('disabled');
			}
		});
		refreshStt();
	});
}

//refresh stt
function refreshStt() {
	var stt = 1;
	$( "#indexCategoryChoie > tbody > tr" ).each(function(){
		$(this).find("td.stt").html(stt);
		stt++;
	});
}