$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    clear($("#group"));
    clear($("#subject"));
    clear($("#teacher"));
    clear($("#student"));
    $("#divSemester").on('change', function () {
        var semester = parseInt($("#divSemester").val());
        selectSemester(semester);
    });
    $("#group").change(function () {
        var group = parseInt($("#group").val());
        selectGroup(group);
    });
    $("#subject").change(function () {
        var subject = parseInt($("#subject").val());
        selectSubject(subject);
    });
    $("#teacher").change(function () {
        var teacher = parseInt($("#teacher").val());
        selectTeacher(teacher);
    });
//
    function selectSemester(semester) {
        var group = $("#group");
        $("#divGroup, #divSubject, #divTeacher, #divStudent").hide();
        clear(group);
        clear($("#subject"));
        clear($("#teacher"));
        clear($("#student"));

        if (semester > 0) {
            $("#divGroup").fadeIn("slow");
            group.attr("disabled", false);
            group.load(
                "/assignments/get-data",
                {semester: semester}
            )
        }
    }

    function selectGroup(group) {
        var subject = $("#subject");
        var semester = parseInt($("#divSemester").val());

        $("#divSubject, #divTeacher, #divStudent").hide();
        clear(subject);
        clear($("#teacher"));
        clear($("#student"));

        if (group > 0) {

            $("#divSubject").fadeIn("slow");
            subject.attr("disabled", false);
            subject.load(
                "/assignments/get-data",
                {group: group, semesterId: semester}
            );
        }
    }

    function selectSubject(subject) {
        var semester = parseInt($("#divSemester").val());
        var group = parseInt($("#group").val());
        var teacher = $("#teacher");
        $("#divTeacher, #divStudent").hide();
        clear(teacher);
        clear($("#student"));
        if (subject > 0) {
            $("#divTeacher").fadeIn("slow");
            teacher.attr("disabled", false);
            teacher.load(
                "/assignments/get-data",
                {subject: subject, semesterId: semester, groupId: group}
            );
        }
    }

    function selectTeacher(teacher) {
        var semester = parseInt($("#divSemester").val());
        var group = parseInt($("#group").val());
        var subject = parseInt($("#subject").val());
        var student = $("#student");

        $("#divStudent").hide();
        clear(student);
        if (teacher > 0) {
            $("#divStudent").fadeIn("slow");
            student.attr("disabled", false);
            student.load(
                "/assignments/get-data",
                {teacher: teacher, subjectId: subject, semesterId: semester, groupId: group}
            );
        }
    }

    function clear(val) {
        val.empty();
        val.attr("disabled", true);
    }
});
