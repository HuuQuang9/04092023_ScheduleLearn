(function ($) {
    "use strict"; // Start of use strict

    const table = $("#dataTable");

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $(".sidebar .collapse").collapse("hide");
        }

        // Set width table from data-table
        table.DataTable().columns.adjust();
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $(".sidebar .collapse").collapse("hide");
        }

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $("body.fixed-nav .sidebar").on(
        "mousewheel DOMMouseScroll wheel",
        function (e) {
            if ($(window).width() > 768) {
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;
                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
            }
        }
    );

    // Scroll to top button appear
    $(document).on("scroll", function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on("click", "a.scroll-to-top", function (e) {
        var $anchor = $(this);
        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr("href")).offset().top,
                },
                1000,
                "easeInOutExpo"
            );
        e.preventDefault();
    });

    // Data table config
    if (table.length) {
        table.DataTable({
            lengthChange: true,
            info: true,
            scrollX: true,
            language: {
                lengthMenu: "Hiển thị _MENU_",
                search: "Tìm kiếm",
                info: " _PAGE_ / _PAGES_ ",
                paginate: {
                    previous: '<i class="fas fa-chevron-left"></i>',
                    next: '<i class="fas fa-chevron-right"></i>',
                },
            },
        });
    }


    let id = 0;
    $(document).on("click", ".delete", function () {
        id = $(this).attr("data-id");
    });

    $(document).on("click", "#click-delete-form", function () {
        document.getElementById(`form-submit-delete-${id}`).submit();
    });

    const currentUrl = window.location.href;
    const baseUrl = window.location.protocol + "//" + window.location.host;

    // Link gọi giảng viên theo ID lớp học
    const getLecturersByClassroom = async (id) => {
        const data = await axios({
            method: "get",
            url: `${baseUrl}/api/lecturers/getItemsByClassroom/${id}`,
            responseType: "json",
        });
        return data.data;
    };

    // Link gọi môn học theo ID lớp học
    const getSubjectsByClassroom = async (id) => {
        const data = await axios({
            method: "get",
            url: `${baseUrl}/api/subjects/getItemsByClassroom/${id}`,
            responseType: "json",
        });
        return data.data;
    };

    // Link gọi học viên theo ID lịch hocj
    const getStudentsBySchedule = async (id, lessonDate, classroomId) => {
        const params = {
            date: lessonDate,
            classroom_id: classroomId
        };
        const data = await axios({
            method: "post",
            url: `${baseUrl}/api/students/getItemsBySchedule/${id}`,
            responseType: "json",
            data: params
        });
        return data.data;
    };

    // Link gọi bài học theo ID lịch hoc
    const getLessonsBySchedule = async (id, classroomId) => {
        const params = {
            classroom_id: classroomId,
            subject_id: id,
        }
        const data = await axios({
            method: "POST",
            url: `${baseUrl}/api/lessons/getItemsBySchedule`,
            responseType: "json",
            data: params
        });
        return data.data;
    };

    const inputElement = document.getElementById("classroom");
    const subjectSelect = document.getElementById("subject");
    const lecturerSelect = document.getElementById("lecturer");

    const handleRender = async (id, subjectId, lecturerId) => {
        const lecturersPromise = getLecturersByClassroom(id);
        const subjectsPromise = getSubjectsByClassroom(id);

        const lecturers = await lecturersPromise;
        const subjects = await subjectsPromise;

        // Xóa các phần tử <option> cũ
        subjectSelect.innerHTML = "<option value=''>Chọn môn học...</option>";
        lecturerSelect.innerHTML =
            "<option value=''>Chọn giảng viên...</option>";

        // Render dữ liệu vào các select
        subjects.forEach((subject) => {
            const option = document.createElement("option");
            option.value = subject.id;
            option.textContent = subject.name;
            if (subjectId && subjectId == subject.id) {
                option.selected = true;
            }
            subjectSelect.appendChild(option);
        });

        lecturers.forEach((lecturer) => {
            const option = document.createElement("option");
            option.value = lecturer.id;
            option.textContent = lecturer.full_name;
            if (lecturerId && lecturerId == lecturer.id) {
                option.selected = true;
            }
            lecturerSelect.appendChild(option);
        });
    };

    const handleData = async () => {
        if (!inputElement) return;
        let classroomId = inputElement.value;
        const subjectId = subjectSelect.dataset.id;
        const lecturerId = lecturerSelect?.dataset?.id ?? 0;
        // Thêm sự kiện lắng nghe sự thay đổi của input
        inputElement.addEventListener("input", () => {
            classroomId = inputElement.value;
            handleRender(classroomId, subjectId, lecturerId);
        });

        if (classroomId) {
            handleRender(classroomId, subjectId, lecturerId);
        }
    };

    // Xủ lý điểm danh
    const handleAttendances = async () => {
        const schedule = document.querySelector(".attendance-add #subject-report");
        const classroom = document.querySelector(".attendance-add #classroom-report");
        const bodyTable = document.querySelector("#dataTable tbody");
        // Lắng nghe thay đổi lịch dạy
        if (schedule && schedule.length) {
            schedule.onchange = async () => {
                const scheduleId = schedule.value;
                const classroomId = classroom.value;
                const lessonsPromise = getLessonsBySchedule(scheduleId, classroomId);
                const lessons = await lessonsPromise;
                bodyTable.innerHTML = "";
                // Render dữ liệu vào các select
                let lessonNot = null;
                lessons.forEach((lesson) => {
                    if (lesson.is_attendance) {} else {
                        if (!lessonNot) {
                            lessonNot = lesson;
                        }
                    }
                });
                if (!lessonNot) {
                    lessonNot = lessons[lessons.length - 1];
                }
                $('#times').css('display', 'none');
                if (lessonNot) {
                    $('#lesson_date').val(lessonNot.date);
                    const lessonDate = document.querySelector("#lesson_date");
                    const lesson_date = lessonDate.value;
                    const schedulesPromise = getStudentsBySchedule(
                        scheduleId,
                        lesson_date,
                        classroom.value,
                    );
                    const res = await schedulesPromise;
                    setStudents(res);
                }
            };
        }
    };

    const checkBoxArr = [
        { name: "Đi muộn", value: "M" },
        { name: "Nghỉ", value: "N" },
        { name: "Học", value: "H" },
        { name: "Nghỉ có phép", value: "P" },
    ];

    const handleLessons = async () => {
        // Lắng nghe thay đổi lịch dạy
        const lessonDate = document.querySelector("#lesson_date");
        const schedule = document.querySelector(".attendance-add #subject-report");
        const classroom = document.querySelector(".attendance-add #classroom-report");
        if (!lessonDate) {
            return false;
        }
        lessonDate.onchange = async () => {
            const scheduleId = schedule.value;
            if (!scheduleId) {
                $("#toast-error .toast-body").html("Vui lòng chọn lịch dạy");
                return $("#toast-error").toast("show");
            }
            const lesson_date = lessonDate.value;
            const schedulesPromise = getStudentsBySchedule(
                scheduleId,
                lesson_date,
                classroom.value
            );
            const res = await schedulesPromise;
            setStudents(res);
        };
    };

    function setStudents(res) {
        const students = res.students;
        const lessonResult = res.lesson;
        const contentTable = document.querySelector("#content_table");
        const bodyTable = document.querySelector("#dataTable tbody");
        if (lessonResult) {
            if (lessonResult.start_time) {
                $('#start_time').val(lessonResult.start_time);
            }
            if (lessonResult.end_time) {
                $('#end_time').val(lessonResult.end_time);
            }
        }
        if (students.length) {
            $('#times').css('display', 'flex');
        } else {
            $('#times').css('display', 'none');
        }
        document.querySelector("#notification_table").style.display =
            "none";
        document.querySelector("#btn-save").style.display = "block";
        contentTable.style.display = "block";

        bodyTable.innerHTML = "";
        const attendanceChecked = [];
        students.forEach((e, index) => {
            let contentTr = `<tr data-id="${e.id}" data-code="${e.code}">`;
            contentTr += `<td class="text-center align-middle">${
                index + 1
            }</td>`;
            contentTr += `<td class="text-center align-middle">${e.code}</td>`;
            contentTr += `<td class="text-center align-middle">${e.full_name}</td>`;
            contentTr += `<td class="text-center align-middle">`;
            checkBoxArr.forEach((check) => {
                contentTr += `<div class="form-check form-check-inline">`;
                contentTr += ` <input class="form-check-input" type="radio" name="attendance-${e.id}" id="attendance-${e.id}-${check.value}" value="${check.value}" required>`;
                contentTr += `<label class="form-check-label" for="attendance-${e.id}-${check.value}">${check.name}</label>`;
                contentTr += `</div>`;
                if (e.attendance == check.value) {
                    attendanceChecked.push(
                        "#" + `attendance-${e.id}-${check.value}`
                    );
                }
            });
            contentTr += `</td>`;
            contentTr += `<td class="text-center align-middle"></td>`;
            contentTr += `</tr>`;
            $(contentTr).appendTo("#dataTable tbody");
        });
        attendanceChecked.forEach((e) => {
            $(e).prop("checked", true);
        });
        table.DataTable().columns.adjust();
    }

    $('.attendance #start_time').change(function(){
        const val = $(this).val();
        var curDate = new Date();
        var hours = curDate.getHours();
        hours = (hours < 10 ? "0" : "") + hours;
        var minutes = curDate.getMinutes();
        minutes = (minutes < 10 ? "0" : "") + minutes;
        var hourNow = hours + ':' + minutes;
        var hourArr = hourNow.split(':');
        var valArr = val.split(':');
        if (valArr[0] > hourArr[0]) {
            document.getElementById('start_time').value = hourNow;
        } else {
            if (valArr[0] = hourArr[0]) {
                if (valArr[1] > hourArr[1]) {
                    document.getElementById('start_time').value = hourNow;
                }
            }
        }
    });
    
    $('.attendance #end_time').change(function(){
        const val = $(this).val();
        var curDate = new Date();
        var hours = curDate.getHours();
        hours = (hours < 10 ? "0" : "") + hours;
        var minutes = curDate.getMinutes();
        minutes = (minutes < 10 ? "0" : "") + minutes;
        var hourNow = hours + ':' + minutes;
        var hourArr = hourNow.split(':');
        var valArr = val.split(':');
        if (valArr[0] < hourArr[0]) {
            document.getElementById('end_time').value = hourNow;
        } else {
            if (valArr[0] = hourArr[0]) {
                if (valArr[1] < hourArr[1]) {
                    document.getElementById('end_time').value = hourNow;
                }
            }
        }
    });

    $(document).on("click", "#submitAttendance", async function () {
        const params = [];
        const errors = [];
        const lesson = document.querySelector("#lesson_date");
        const schedule = document.querySelector(".attendance-add #subject-report");
        const classroom = document.querySelector(".attendance-add #classroom-report");
        const scheduleId = schedule.value;
        const classroomId = classroom.value;
        $("#dataTable tbody tr").each(function (index) {
            const studentId = $(this).data("id");
            const attendance = $(this)
                .find(`input[name="attendance-${studentId}"]:checked`)
                .val();
            if (attendance == undefined) {
                errors.push(
                    "Học viên " + $(this).data("code") + " chưa được điểm danh"
                );
            } else {
                params.push({
                    student_id: studentId,
                    attendance: attendance,
                });
            }
        });
        if (errors.length) {
            $("#toast-error .toast-body").html(
                "Vui lòng điểm danh học viên. " + errors[0]
            );
            return $("#toast-error").toast("show");
        }
        const token = $('meta[name="csrf-token"]').attr("content");
        const start_time = $('#start_time').val();
        const end_time = $('#end_time').val();
        const data = await axios.post(
            `${baseUrl}/api/attendances/`,
            { students: params, start_time: start_time, end_time: end_time, lesson_date: lesson.value, schedule_id: scheduleId, classroom_id: classroomId},
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "X-CSRF-TOKEN": token,
                },
            }
        );
        if (data.data["status"]) {
            return $("#toast-success").toast("show");
        }
    });

    const handleLessonSchedule = async () => {
        const schedule = document.getElementById("lesson-schedule");
        if (schedule && schedule.length) {
            schedule.addEventListener('change', async function handleChange(event) {
                const scheduleId = event.target.value;
                const data = await axios({
                    method: "get",
                    url: `${baseUrl}/api/lessons/getItemsByScheduleToHtml/${scheduleId}`,
                    responseType: "json",
                });
                const html = data.data;
                table.DataTable().clear().draw();
                $('#dataTable tbody').html(html);
                table.DataTable().rows.add({});
                table.DataTable().columns.adjust();
            });   
        }
    };

    const handleScheduleClassroom = async () => {
        const classroom = document.getElementById("schedule-classroom");
        if (classroom && classroom.length) {
            classroom.addEventListener('change', async function handleChange(event) {
                const classroomId = event.target.value;
                const data = await axios({
                    method: "get",
                    url: `${baseUrl}/api/schedules/getItemsByClassroomToHtml/${classroomId}`,
                    responseType: "json",
                });
                const html = data.data;
                table.DataTable().clear().draw();
                $('#dataTable tbody').html(html);
                table.DataTable().rows.add({});
                table.DataTable().columns.adjust();
            });
        }
    }

    $(".select-multiple").selectpicker();
    $(".toast").toast({ delay: 7000 });
    handleData();
    handleAttendances();
    handleLessons();
    handleLessonSchedule();
    handleScheduleClassroom();

    const selectElement = document.querySelector(".report #subject");
    if (selectElement) {
        selectElement.addEventListener("change", async (event) => {
            const val = event.target.value;
            $('.change-canvas').html('<canvas id="attendanceChart" class="canvas"></canvas>');
            const ctx = document.getElementById('attendanceChart');
            const params = {
                subject_id: val,
                classroom_id: $('#classroom').val()
            };
            const data = await axios({
                method: "post",
                url: `${baseUrl}/api/lessons/getReportItemsBySchedule/`,
                responseType: "json",
                data: params,
            });
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            var dataChart = data.data;
            for (var i in dataChart) {
                var coloR = dynamicColors();
            }
    
            const config = {
                type: 'bar',
                data: dataChart,
                options: {
                  responsive: true,
                  plugins: {
                    legend: {
                      position: 'top',
                    },
                    title: {
                      display: true,
                      text: 'Thống kê buổi học theo lịch học'
                    }
                  }
                }
            };
            new Chart(ctx, config);
        });
    }

    const subjectReport = document.querySelector(".report #subject-report");
    if (subjectReport) {
        subjectReport.addEventListener("change", async (event) => {
            $('#content_table').html('<table class="table table-bordered" id="dataTableReport" width="100%" cellspacing="0"></table>');
            const val = event.target.value;
            const classroomId = $('#classroom-report').val();
            const params = {
                subject_id: val,
                classroom_id: classroomId,
            };
            const data = await axios({
                method: "post",
                url: `${baseUrl}/api/attendances/report`,
                responseType: "json",
                data: params
            });
            const res = data.data;
            if (res.body.length && res.head.length) {
                const tableReport = $("#dataTableReport");
                tableReport.DataTable({
                    lengthChange: true,
                    info: true,
                    scrollX: true,
                    data: res.body,
                    columns: res.head,
                });
                tableReport.DataTable().columns.adjust();
            } else {
                
            }
        });
    }
    
    const classroomReport = document.querySelector("#classroom-report");
    if (classroomReport) {
        classroomReport.addEventListener("change", async (event) => {
            const val = event.target.value;
            const data = await axios({
                method: "get",
                url: `${baseUrl}/api/schedules/getItemsByClassroom/${val}`,
                responseType: "json",
            });
            const res = data.data;
            // Xóa các phần tử <option> cũ
            const subjectSelect = document.getElementById("subject-report");
            subjectSelect.innerHTML = "<option value=''>Chọn môn học...</option>";

            // Render dữ liệu vào các select
            res.forEach((subject) => {
                const option = document.createElement("option");
                option.value = subject.id;
                option.textContent = subject.name;
                subjectSelect.appendChild(option);
            });
        });
    }

    const attendanceSubject = document.querySelector(".attendance #subject-report");
    if (attendanceSubject) {

    }
})(jQuery); // End of use strict
