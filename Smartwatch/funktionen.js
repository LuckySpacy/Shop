function CheckboxKlickEvent(element) {
	//alert(element);
	var formular = document.getElementById("smartformid");
	//alert('test');
	formular.submit();
	//document.getElementById("smartformid").submit();
}	

function getCheckbox(Labelname) {
	for (let checkbox of document.getElementsByClassName("checkbox")) {
		let TagP = checkbox.getElementsByTagName('p');
		if (Labelname == TagP[0].innerHTML) {
			return checkbox;
		};
	}
}	

function SetzeCheckboxHoehe(Labelname, Anzahl) {
	let Checkbox = getCheckbox(Labelname);
	let Kopfhoehe = 2.0;
	let Checkboxeinzelhoehe = 1.6;
	let Checkboxgesamthoehe = Checkboxeinzelhoehe * Anzahl;
	let Boxhoehe = Checkboxgesamthoehe + Kopfhoehe;
	if (Boxhoehe > 12) {Boxhoehe = 12;}
	Checkbox.style.height = Boxhoehe + 'em';
	/*
	let Checkbox = getCheckbox(Labelname);
	let Kopfhoehe = 22;
	let Checkboxeinzelhoehe = 17;
	let Checkboxgesamthoehe = 17 * Anzahl;
	let Boxhoehe = Checkboxgesamthoehe + Kopfhoehe + 5;
	if (Boxhoehe > 150) {Boxhoehe = 150;}
	//alert(Boxhoehe);
	Checkbox.style.height = Boxhoehe + 'px';
	//Checkbox.style.height = '200px';
	*/
}

