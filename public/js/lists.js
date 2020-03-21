$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
//TRANSCRIPT
	$("#divFaculty").on('change', function(){
		var faculties = parseInt( $("#divFaculty").val() );
		selectDepartment(faculties);
	});

	$("#department").change(function(){
		var department = parseInt( $("#department").val() );
		selectGroup(department);
	});
	$("#group").change(function(){
		var group = parseInt( $("#group").val() );
		selectStudent(group);
	});
	$("#studenT").change(function(){
		var student = parseInt( $("#studenT").val() );
		selectTranscript(student);
	});
	//END OF TRANSCRIPT

    $("#listFaculty").on('change', function(){
        var faculties = parseInt( $("#listFaculty").val() );
        selectDep1(faculties);
    });
    $("#dep1").change(function(){
        var department = parseInt( $("#dep1").val() );
        selectGroup1(department);
    });
    $("#group1").change(function(){
        var group = parseInt( $("#group1").val() );
        selectListStudent(group);
    });


});

function selectDepartment(faculties){
	var department = $("#department");
	$("#divDepartment, #divGroup, #divStudenT, #divTranscript").hide();
	clear(department);
	clear($("#group"));
	clear($("#studenT"));
	clear($("#transcript"));

	if(faculties > 0){
		$("#divDepartment").fadeIn("slow");
		department.attr("disabled", false);
		department.load(
			"/transcript",
            {faculty: faculties}
        );
	}
}
function selectGroup(department){
	var group = $("#group");

	$("#divGroup, #divStudenT, #divTranscript").hide();
	clear(group);
    clear($('#studenT'));
    clear($('#transcript'));
	if(department > 0){

		$("#divGroup").fadeIn("slow");
		group.attr("disabled", false);
		group.load(
			"/transcript",
            {department: department}
		);
	}
}
function selectStudent(group){
	var student = $("#studenT");

	$("#divStudenT, #divTranscript").hide();
	clear(student);
	clear($('#transcript'));

	if(group > 0){

		$("#divStudenT").fadeIn("slow");
        student.attr("disabled", false);
        student.load(
			"/transcript",
            {student: group}
		);
	}
}
function selectTranscript(student){
	var transcript = $("#transcript");

	$("#divTranscript").hide();
	clear(transcript);

	if(student > 0){

		$("#divTranscript").fadeIn("slow");
        transcript.load(
			"/transcript",
            {transcript: student}
		);
	}
}

function selectDep1(faculties){
    var department = $("#dep1");
    $("#listDepartment, #listGroup, #listStudent").hide();
    clear(department);
    clear($("#group1"));
    clear($("#lists"));

    if(faculties > 0){
        $("#listDepartment").fadeIn("slow");
        department.attr("disabled", false);
        department.load(
            "/list-students",
            {faculty: faculties}
        );
    }
}
function selectGroup1(department){
    var group = $("#group1");

    $("#listGroup, #listStudent").hide();
    clear(group);
    clear($('#lists'));
    if(department > 0){

        $("#listGroup").fadeIn("slow");
        group.attr("disabled", false);
        group.load(
            "/list-students",
            {department: department}
        );
    }
}
function selectListStudent(group){
    var student = $("#lists");

    $("#listStudent").hide();
    clear(student);

    if(group > 0){

        $("#listStudent").fadeIn("slow");
        student.attr("disabled", false);
        student.load(
            "/list-students",
            {group: group}
        );
    }
}

function clear(val){
	val.empty();
	val.attr("disabled", true);
}



//total rating

$('#assignment1_faculty').on("change",function () {
    hideAssignment(true);
    if($(this).val()){
        showAssignment(true);
        LoadData($("#assignment1_department"),$(this).val());
    }
    else{  hideAssignment(true);}

});
$('#assignment1_department').on("change",function () {
    hideAssignment(false,true);
    if($(this).val()){
        showAssignment(false,true);
        LoadData($("#assignment1_group"),$('#assignment1_faculty').val(),$(this).val());
    }
    else{
        hideAssignment(false,true);
    }

});
$('#assignment1_group').on("change",function () {
    hideAssignment(false,false,true);
    if($(this).val()) {
        showAssignment(false, false, true);
        LoadData($("#assignment1_subject"), $('#assignment1_faculty').val(), $('#assignment1_department').val(), $(this).val());
    }
    else{
        hideAssignment(false,false,true);
    }
});
$('#assignment1_subject').on("change",function () {
    hideAssignment(false,false,false,true);
    if($(this).val()){
        showAssignment(false,false,false,true);
        LoadData($("#transcript2"),$('#assignment1_faculty').val(),$('#assignment1_department').val(),$('#assignment1_group').val(),$(this).val());
    }
    else{
        hideAssignment(false,false,false,true);
    }

});



function LoadData(element,faculty_id,department_id,group_id,subject_id) {
        element.load("/list-assign",{faculty_id:faculty_id,department_id:department_id,group_id:group_id,subject_id:subject_id})
}
function hideAssignment(department = false,group = false,subject = false,transcript = false) {
    if(department){
        $("#div_assignment1_department,#div_assignment1_group,#div_assignment1_subject,#divTranscript2").hide();
        $("#assignment1_department,#assignment1_group,#assignment1_subject,#transcript2").empty();
    }
    if(group){
        $("#div_assignment1_group,#div_assignment1_subject,#divTranscript2").hide();
        $("#assignment1_group,#assignment1_subject,#transcript2").empty();
    }
    if(subject){
        $("#div_assignment1_subject,#divTranscript2").hide();
        $("#assignment1_subject,#transcript2").empty();
    }
    if(transcript){
        $("#divTranscript2").hide();
    }
}
function showAssignment(department = false,group = false,subject = false,transcript = false) {
    if(department){
        $("#div_assignment1_department").fadeIn();
    }
    if(group){
        $("#div_assignment1_group",).fadeIn();
    }
    if(subject){
        $("#div_assignment1_subject").fadeIn();
    }
    if(transcript){
        $("#divTranscript2").fadeIn();
    }
}
