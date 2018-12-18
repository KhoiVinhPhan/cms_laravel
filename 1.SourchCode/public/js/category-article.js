$(document).ready(function(){
	showCategory();
});
//add category
function insertCategoryArr(){
	$("#categorys > option").each(function(){
		if (this.selected && !this.disabled) {
			insertCategory(this);
		}
	});
}

//add all categories
function insertAllCategoryArr(){
	$("#categorys > option").each(function(){
		if (!this.disabled) {
			insertCategory(this);
		}
	});
}

//show category
function showCategory(){
	$( "#categoryIdArr" ).find("input").each(function(){
		var category_id = $(this).val();
		$( "#categorys > option" ).each(function(){
			if (this.value == category_id) {
				insertCategory(this);
			}
		});
	});
}

//delete category
function deleteCategory(){
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

//insert category
function insertCategory(element){
	var len = $( "#indexCategoryChoie > tbody > tr" ).length + 1;
	var text = element.text.replace(new RegExp('-', 'g'),"")
	var html = 
		'<tr id="group-category">'
		+	'<td class="stt">'+len+'</td>'
		+	'<td width="70%">'+text
		+		'<input hidden type="input" name="categoryId[]" class="id-category" value="'+element.value+'">'
		+	'</td>'
		+	'<td><span class="button-delete" onclick="deleteCategory()"><a href="javascript:;">Xóa</a></span></td>'
		+'</tr>';
	$( "#indexCategoryChoie" ).append(html);
	$(element).attr('disabled','disabled');

	$( "#group-category" ).each(function(){
		$(element).find("input.id-category").attr('name', 'categoryId[]');
	});
}

//refresh stt
function refreshStt(){
	var stt = 1;
	$( "#indexCategoryChoie > tbody > tr" ).each(function(){
		$(this).find("td.stt").html(stt);
		stt++;
	});
}

