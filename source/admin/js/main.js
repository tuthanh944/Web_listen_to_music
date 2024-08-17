//Thời Gian
function time() {
	var today = new Date();
	var weekday = new Array(7);
	weekday[0] = "Chủ Nhật";
	weekday[1] = "Thứ Hai";
	weekday[2] = "Thứ Ba";
	weekday[3] = "Thứ Tư";
	weekday[4] = "Thứ Năm";
	weekday[5] = "Thứ Sáu";
	weekday[6] = "Thứ Bảy";
	var day = weekday[today.getDay()];
	var dd = today.getDate();
	var mm = today.getMonth() + 1;
	var yyyy = today.getFullYear();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	nowTime = h + " giờ " + m + " phút " + s + " giây";
	if (dd < 10) {
		dd = '0' + dd
	}
	if (mm < 10) {
		mm = '0' + mm
	}
	today = day + ', ' + dd + '/' + mm + '/' + yyyy;
	tmp = '<span class="date"> ' + today + ' - ' + nowTime +
		'</span>';
	document.getElementById("clock").innerHTML = tmp;
	clocktime = setTimeout("time()", "1000", "Javascript");

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}
}
//In dữ liệu
var myApp = new function () {
	this.printTable = function () {
		var tab = document.getElementById('musicTable');
		var win = window.open('', '', 'height=700,width=700');
		win.document.write(tab.outerHTML);
		win.document.close();
		win.print();
	}
}

/*--------------------------------Export--------------------------------*/


function exportExcel(id) {
	// Lấy bảng dữ liệu
	var table = document.getElementById(id);

	// Tạo bảng dữ liệu mới, không bao gồm cột đầu tiên và cuối cùng
	var newTable = [];
	for (var i = 0; i < table.rows.length; i++) {
		var row = [];
		for (var j = 1; j < table.rows[i].cells.length - 1; j++) {
			row.push(table.rows[i].cells[j].textContent);
		}
		newTable.push(row);
	}

	// Tạo workbook và worksheet mới
	var workbook = XLSX.utils.book_new();
	var worksheet = XLSX.utils.aoa_to_sheet(newTable);

	// Thêm worksheet vào workbook
	XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

	// Xuất file Excel
	XLSX.writeFile(workbook, "data.xlsx");

}

function exportPdf(id){
	// Lấy bảng dữ liệu
	var table = document.getElementById(id);

// Tạo bảng dữ liệu mới, không bao gồm cột đầu tiên và cuối cùng
	var newTable = [];
	for (var i = 0; i < table.rows.length; i++) {
		var row = [];
		for (var j = 1; j < table.rows[i].cells.length - 1; j++) {
			row.push(table.rows[i].cells[j].textContent);
		}
		newTable.push(row);
	}

// Tạo đối tượng pdf
	var doc = new jsPDF();

// Thêm nội dung vào pdf
	doc.autoTable({
		head: [ // Tiêu đề bảng
			['ID bài hát', 'Tên bài hát', 'Thể loại', 'Ca sĩ', 'Năm phát hành', 'Dữ liệu', 'Hình ảnh']
		],
		body: newTable // Dữ liệu bảng
	});

// Xuất file PDF
	doc.save('data.pdf');

}