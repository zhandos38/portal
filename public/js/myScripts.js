$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#reservation').daterangepicker();
    //Date picker
    $('.datepicker').datepicker({
        autoclose: true
    })
    //Timepicker
    $('.timepicker').datetimepicker({
        format: 'LT'
    });
    $(".datetimepicker").datetimepicker();
    // $("#start").datepicker({});
    // $("#end").datepicker({});
    $('.select2').select2()

$('.currentSemester').on('change', function () {
    var checked = $(this).prop('checked');
    var id = $(this).attr("data-id");

    $.ajax({
        type: "POST",
        url: "/current-semesters",
        async: true,
        data: {
            id: id,checked:checked
        },
        success: function (msg) {
            console.log('Успешно изменено!');
            location.reload(true);
        },
        error:function (e) {
            console.log("Ошибка!");
        }
    });
})

$('.stepSelect').on('change', function () {
    var select = $(this).val();
    var id = $(this).attr("data-id");
    $.ajax({
        type: "POST",
        url: '/step-semester',
        async: true,
        data: {id: id, value: select},
        success: function () {
            console.log('ok')
        },
        error: function () {
            console.log('error');
        }
    })
})

$(".roles").on("change",function () {
    var value = $(this).val();

    if(value == 1 || value == 6){
        hideForm(true,true,true)
    }
    if(value == 2 || value == 3){
        hideForm(false,true,true)
    }
    if(value == 4){
        hideForm(true,false,true)
    }
    if(value == 5){
        hideForm(true,true,false)
    }
    function hideForm(faculty,department,group) {
        $(".faculty").attr("hidden",faculty);
        $(".department").attr("hidden",department);
        $(".group").attr("hidden",group);
    }

})

//exam schedule
    $(".exam-semester").on("change",function () {
        if($(this).val()==0){
            clearExamInput();
            showExamInput(false);
        }
        else{
            clearExamInput();
            showExamInput(true);
            setExamData($(".exam-subjects"),$(".exam-semester").val())
        }


    });
    $(".exam-subjects").on("change",function () {
        if($(this).val()==0){
            clearExamInput(false,true);
            showExamInput(true,false,);
        }
        else {
            clearExamInput(false,true);
            showExamInput(true,true,);
            setExamData($(".exam-groups"),$(".exam-semester").val(),$(".exam-subjects").val())
        }

    });
    $(".exam-groups").on("change",function () {
        if($(this).val()==0){
            clearExamInput(false,false,true);
            showExamInput(true,true);
        }
        else{
            $(".exam-types").fadeOut();
            clearExamInput(false,false,true);
            showExamInput(true,true,true);
            setExamData($(".exam-types"),$(".exam-semester").val(),$(".exam-subjects").val(),$(".exam-groups").val());
        }
    });
    $(".exam-types").on("change",function () {
        if($(this).val() == 0){
            clearExamInput(false,false,false);
            showExamInput(true,true,true);
        }
        if($(this).val() != 3 && $(this).val() != 0){
            clearExamInput(false,false,false);
            showExamInput(true,true,true,false,true,true,true,true);
        }
        if($(this).val() == 3){
            clearExamInput(false,false,false);
            showExamInput(true,true,true,true,true,true,true,true);
            setExamData($(".exam-tests"),$(".exam-semester").val(),$(".exam-subjects").val(),$(".exam-groups").val(),$(".exam-types").val())
        }

    })

    function setExamData(element,semester_id,subject_id,group_id,test_id) {
        element.load("/examSchedules/getData",{semester_id:semester_id,subject_id:subject_id,group_id:group_id,test_id:test_id});
    }

    function showExamInput(subject,group,type,test,start,end,time,cabinet) {
        subject == true ? $(".exam-subject").fadeIn() : $(".exam-subject").fadeOut();
        group == true ? $(".exam-group").fadeIn() : $(".exam-group").fadeOut();
        type == true ? $(".exam-type").fadeIn() : $(".exam-type").fadeOut();
        test == true ? $(".exam-test").fadeIn() : $(".exam-test").fadeOut();
        start == true ? $(".exam-start").fadeIn() : $(".exam-start").fadeOut();
        end == true ? $(".exam-end").fadeIn() : $(".exam-end").fadeOut();
        time == true ? $(".exam-time").fadeIn() : $(".exam-time").fadeOut();
        cabinet == true ? $(".exam-cabinet").fadeIn() : $(".exam-cabinet").fadeOut();
    }
    function clearExamInput(subject = true,group = true,type = true,test =true,start = true,end =true,time=true,cabinet=true) {
        subject == true ? $(".exam-subjects").empty() : "";
        group == true ? $(".exam-groups").empty() : "";
        type == true ? $(".exam-types").empty() : "";
        test == true ? $(".exam-tests").empty() : "";
        start == true ? $(".exam-starts").val("") : "";
        end == true ? $(".exam-ends").val("") : "";
        time == true ? $(".exam-times").val("") : "";
        cabinet == true ? $(".exam-cabinets").val("") : "";
    }
    //end of exam schedule
    // $('#quizzes-table-property').DataTable({
    //     "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
    //     buttons: [
    //         {
    //             extend: 'print',
    //             exportOptions: {
    //                 columns: ':visible'
    //             }
    //         },
    //         'csvHtml5',
    //         'excelHtml5',
    //         'colvis',
    //     ]
    // });
    //
    // $('#questions_table').DataTable({
    //     "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
    //     buttons: [
    //         {
    //             extend: 'print',
    //             exportOptions: {
    //                 columns: ':visible'
    //             }
    //         },
    //         'csvHtml5',
    //         'excelHtml5',
    //         'colvis',
    //     ],
    //     columnDefs: [
    //         { targets: [7,8,9,10], visible: false},
    //     ]
    // });
    //
    // $('#search').DataTable({
    //     'paging'      : false,
    //     'lengthChange': false,
    //     'searching'   : true,
    //     'ordering'    : false,
    //     'info'        : false,
    //     'autoWidth'   : true,
    //     "sDom": "<'row'><'row'<'col-md-4'B><'col-md-8'f>r>t<'row'>",
    //     buttons: [
    //         {
    //             extend: 'print',
    //             exportOptions: {
    //                 columns: ':visible'
    //             }
    //         },
    //         'excelHtml5',
    //         'csvHtml5',
    //         'colvis',
    //     ]
    // });
    //
    // $('#topTable').DataTable({
    //     "order": [[ 5, "desc" ]],
    //     "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    //     "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
    //     buttons: [
    //         {
    //             extend: 'print',
    //             exportOptions: {
    //                 columns: ':visible'
    //             }
    //         },
    //         'excelHtml5',
    //         'csvHtml5',
    //         'colvis',
    //     ]
    // });
    $('#checkAll').on('click', function () {
        var checkBox = document.getElementById("checkAll");
        if (checkBox.checked == true){
            $('.iCheck').attr('checked', true);
        }
        if (checkBox.checked == false){
            $('.iCheck').attr('checked', false);
        }
    });

    //MATERIAL
    $(".material-subject").on("change",function () {
        clearMaterialInput();
        if($(this).val() == 0){
            showMaterialInput(false);
        }
        else {
            showMaterialInput(true);
            setMaterial($(".material-groups"),$(this).val());
        }
    });
    $(".material-groups").on("change",function () {
        clearMaterialInput(false,false);
        if($(this).val() == 0){
            showMaterialInput(true);
        }
        else{
            showMaterialInput(true,true);
        }
    });
    $(".material-chooses").on("change",function () {
        clearMaterialInput(false,false,true);
        if($(this).val() == 0){
            showMaterialInput(true,true);
        }
        else{
            showMaterialInput(true,true,true);
            setMaterial($(".material-libraries"),$(".material-subject").val(),$(this).val());
        }
    })
    $(".material-libraries").on("change",function () {
        clearMaterialInput(false,false,false);
        if($(this).val() == 0){
            showMaterialInput(true,true,true);
        }
        else{
            showMaterialInput(true,true,true,true,true);
        }
    });


    function setMaterial(element,subject_id,library_id) {
        element.load("/materials/getData",{subject_id:subject_id,library_id:library_id})
    }
    function clearMaterialInput(groups = true, chooses = true,libraries = true, titles = true, descriptions = true) {
        if (groups) {
            $(".material-groups").empty();
        }
        // if(chooses){
        //     $(".material-chooses").val(0);
        // }
        if (libraries) {
            $(".material-libraries").empty();
        }
        if (titles) {
            $(".material-titles").val("");
        }
        if (descriptions) {
            $(".material-descriptions").val("");
        }
    }
    function showMaterialInput(group = false, choose = false,library = false, title = false, description = false) {
        group == true ? $(".material-group").fadeIn() : $(".material-group").fadeOut();
        choose == true ? $(".material-choose").fadeIn() : $(".material-choose").fadeOut();
        library == true ? $(".material-library").fadeIn() : $(".material-library").fadeOut();
        title == true ? $(".material-title").fadeIn() : $(".material-title").fadeOut();
        description == true ? $(".material-description").fadeIn() : $(".material-description").fadeOut();
    }
    //end of material


    //exam
    $(".page-link2").on("click",function (e) {
        e.preventDefault();
        var id = $(this).attr("data-question");
        hideQuestion(id);

    });

    function hideQuestion(id) {
        $(".questions-other").fadeOut('fast');
        checkAnswers();
        $("#question"+id).fadeIn("slow");
    }
    var answers = {};
    $(".questions-input").on("click",function () {
        var value =  $(this).val();
        var key = $(this).attr("data-key");
        var number = $(this).attr("data-number");

        $("#page-item"+number).css("background","#47bb8b");
        answers[key] = value;
        checkAnswers();
        $("#answers-list").val("answers",answers);
    });

    function checkAnswers() {
        if(Object.keys(answers).length>=40){
            window.onbeforeunload = function () {}
            $(".click-me").attr("disabled",false);
        }
    }
    //end of exam
	
	$(".activeTest").on("change",function () {
       var id = $(this).attr("data-id");
       $.ajax({
           type: "POST",
           url: "/switch-test",
           async: true,

           data: {
               id: id
           },
           success: function (msg) {
               alert('Успешно изменено!');
               location.reload();
           },
           error:function (e) {
               alert("Ошибка!");
           }})

    })

});
