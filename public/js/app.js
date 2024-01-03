/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw new Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw new Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
(function ($) {
  "use strict";

  // Start of use strict
  var table = $("#dataTable");

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
  $("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

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
    $("html, body").stop().animate({
      scrollTop: $($anchor.attr("href")).offset().top
    }, 1000, "easeInOutExpo");
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
          next: '<i class="fas fa-chevron-right"></i>'
        }
      }
    });
  }
  var id = 0;
  $(document).on("click", ".delete", function () {
    id = $(this).attr("data-id");
  });
  $(document).on("click", "#click-delete-form", function () {
    document.getElementById("form-submit-delete-".concat(id)).submit();
  });
  var currentUrl = window.location.href;
  var baseUrl = window.location.protocol + "//" + window.location.host;

  // Link gọi giảng viên theo ID lớp học
  var getLecturersByClassroom = /*#__PURE__*/function () {
    var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(id) {
      var data;
      return _regeneratorRuntime().wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return axios({
              method: "get",
              url: "".concat(baseUrl, "/api/lecturers/getItemsByClassroom/").concat(id),
              responseType: "json"
            });
          case 2:
            data = _context.sent;
            return _context.abrupt("return", data.data);
          case 4:
          case "end":
            return _context.stop();
        }
      }, _callee);
    }));
    return function getLecturersByClassroom(_x) {
      return _ref.apply(this, arguments);
    };
  }();

  // Link gọi môn học theo ID lớp học
  var getSubjectsByClassroom = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(id) {
      var data;
      return _regeneratorRuntime().wrap(function _callee2$(_context2) {
        while (1) switch (_context2.prev = _context2.next) {
          case 0:
            _context2.next = 2;
            return axios({
              method: "get",
              url: "".concat(baseUrl, "/api/subjects/getItemsByClassroom/").concat(id),
              responseType: "json"
            });
          case 2:
            data = _context2.sent;
            return _context2.abrupt("return", data.data);
          case 4:
          case "end":
            return _context2.stop();
        }
      }, _callee2);
    }));
    return function getSubjectsByClassroom(_x2) {
      return _ref2.apply(this, arguments);
    };
  }();

  // Link gọi học viên theo ID lịch hocj
  var getStudentsBySchedule = /*#__PURE__*/function () {
    var _ref3 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3(id, lessonDate, classroomId) {
      var params, data;
      return _regeneratorRuntime().wrap(function _callee3$(_context3) {
        while (1) switch (_context3.prev = _context3.next) {
          case 0:
            params = {
              date: lessonDate,
              classroom_id: classroomId
            };
            _context3.next = 3;
            return axios({
              method: "post",
              url: "".concat(baseUrl, "/api/students/getItemsBySchedule/").concat(id),
              responseType: "json",
              data: params
            });
          case 3:
            data = _context3.sent;
            return _context3.abrupt("return", data.data);
          case 5:
          case "end":
            return _context3.stop();
        }
      }, _callee3);
    }));
    return function getStudentsBySchedule(_x3, _x4, _x5) {
      return _ref3.apply(this, arguments);
    };
  }();

  // Link gọi bài học theo ID lịch hoc
  var getLessonsBySchedule = /*#__PURE__*/function () {
    var _ref4 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee4(id, classroomId) {
      var params, data;
      return _regeneratorRuntime().wrap(function _callee4$(_context4) {
        while (1) switch (_context4.prev = _context4.next) {
          case 0:
            params = {
              classroom_id: classroomId,
              subject_id: id
            };
            _context4.next = 3;
            return axios({
              method: "POST",
              url: "".concat(baseUrl, "/api/lessons/getItemsBySchedule"),
              responseType: "json",
              data: params
            });
          case 3:
            data = _context4.sent;
            return _context4.abrupt("return", data.data);
          case 5:
          case "end":
            return _context4.stop();
        }
      }, _callee4);
    }));
    return function getLessonsBySchedule(_x6, _x7) {
      return _ref4.apply(this, arguments);
    };
  }();
  var inputElement = document.getElementById("classroom");
  var subjectSelect = document.getElementById("subject");
  var lecturerSelect = document.getElementById("lecturer");
  var handleRender = /*#__PURE__*/function () {
    var _ref5 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee5(id, subjectId, lecturerId) {
      var lecturersPromise, subjectsPromise, lecturers, subjects;
      return _regeneratorRuntime().wrap(function _callee5$(_context5) {
        while (1) switch (_context5.prev = _context5.next) {
          case 0:
            lecturersPromise = getLecturersByClassroom(id);
            subjectsPromise = getSubjectsByClassroom(id);
            _context5.next = 4;
            return lecturersPromise;
          case 4:
            lecturers = _context5.sent;
            _context5.next = 7;
            return subjectsPromise;
          case 7:
            subjects = _context5.sent;
            // Xóa các phần tử <option> cũ
            subjectSelect.innerHTML = "<option value=''>Chọn môn học...</option>";
            lecturerSelect.innerHTML = "<option value=''>Chọn giảng viên...</option>";

            // Render dữ liệu vào các select
            subjects.forEach(function (subject) {
              var option = document.createElement("option");
              option.value = subject.id;
              option.textContent = subject.name;
              if (subjectId && subjectId == subject.id) {
                option.selected = true;
              }
              subjectSelect.appendChild(option);
            });
            lecturers.forEach(function (lecturer) {
              var option = document.createElement("option");
              option.value = lecturer.id;
              option.textContent = lecturer.full_name;
              if (lecturerId && lecturerId == lecturer.id) {
                option.selected = true;
              }
              lecturerSelect.appendChild(option);
            });
          case 12:
          case "end":
            return _context5.stop();
        }
      }, _callee5);
    }));
    return function handleRender(_x8, _x9, _x10) {
      return _ref5.apply(this, arguments);
    };
  }();
  var handleData = /*#__PURE__*/function () {
    var _ref6 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee6() {
      var _lecturerSelect$datas, _lecturerSelect$datas2;
      var classroomId, subjectId, lecturerId;
      return _regeneratorRuntime().wrap(function _callee6$(_context6) {
        while (1) switch (_context6.prev = _context6.next) {
          case 0:
            if (inputElement) {
              _context6.next = 2;
              break;
            }
            return _context6.abrupt("return");
          case 2:
            classroomId = inputElement.value;
            subjectId = subjectSelect.dataset.id;
            lecturerId = (_lecturerSelect$datas = lecturerSelect === null || lecturerSelect === void 0 || (_lecturerSelect$datas2 = lecturerSelect.dataset) === null || _lecturerSelect$datas2 === void 0 ? void 0 : _lecturerSelect$datas2.id) !== null && _lecturerSelect$datas !== void 0 ? _lecturerSelect$datas : 0; // Thêm sự kiện lắng nghe sự thay đổi của input
            inputElement.addEventListener("input", function () {
              classroomId = inputElement.value;
              handleRender(classroomId, subjectId, lecturerId);
            });
            if (classroomId) {
              handleRender(classroomId, subjectId, lecturerId);
            }
          case 7:
          case "end":
            return _context6.stop();
        }
      }, _callee6);
    }));
    return function handleData() {
      return _ref6.apply(this, arguments);
    };
  }();

  // Xủ lý điểm danh
  var handleAttendances = /*#__PURE__*/function () {
    var _ref7 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee8() {
      var schedule, classroom, bodyTable;
      return _regeneratorRuntime().wrap(function _callee8$(_context8) {
        while (1) switch (_context8.prev = _context8.next) {
          case 0:
            schedule = document.querySelector(".attendance-add #subject-report");
            classroom = document.querySelector(".attendance-add #classroom-report");
            bodyTable = document.querySelector("#dataTable tbody"); // Lắng nghe thay đổi lịch dạy
            if (schedule && schedule.length) {
              schedule.onchange = /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee7() {
                var scheduleId, classroomId, lessonsPromise, lessons, lessonNot, lessonDate, lesson_date, schedulesPromise, res;
                return _regeneratorRuntime().wrap(function _callee7$(_context7) {
                  while (1) switch (_context7.prev = _context7.next) {
                    case 0:
                      scheduleId = schedule.value;
                      classroomId = classroom.value;
                      lessonsPromise = getLessonsBySchedule(scheduleId, classroomId);
                      _context7.next = 5;
                      return lessonsPromise;
                    case 5:
                      lessons = _context7.sent;
                      bodyTable.innerHTML = "";
                      // Render dữ liệu vào các select
                      lessonNot = null;
                      lessons.forEach(function (lesson) {
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
                      if (!lessonNot) {
                        _context7.next = 20;
                        break;
                      }
                      $('#lesson_date').val(lessonNot.date);
                      lessonDate = document.querySelector("#lesson_date");
                      lesson_date = lessonDate.value;
                      schedulesPromise = getStudentsBySchedule(scheduleId, lesson_date, classroom.value);
                      _context7.next = 18;
                      return schedulesPromise;
                    case 18:
                      res = _context7.sent;
                      setStudents(res);
                    case 20:
                    case "end":
                      return _context7.stop();
                  }
                }, _callee7);
              }));
            }
          case 4:
          case "end":
            return _context8.stop();
        }
      }, _callee8);
    }));
    return function handleAttendances() {
      return _ref7.apply(this, arguments);
    };
  }();
  var checkBoxArr = [{
    name: "Đi muộn",
    value: "M"
  }, {
    name: "Nghỉ",
    value: "N"
  }, {
    name: "Học",
    value: "H"
  }, {
    name: "Nghỉ có phép",
    value: "P"
  }];
  var handleLessons = /*#__PURE__*/function () {
    var _ref9 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee10() {
      var lessonDate, schedule, classroom;
      return _regeneratorRuntime().wrap(function _callee10$(_context10) {
        while (1) switch (_context10.prev = _context10.next) {
          case 0:
            // Lắng nghe thay đổi lịch dạy
            lessonDate = document.querySelector("#lesson_date");
            schedule = document.querySelector(".attendance-add #subject-report");
            classroom = document.querySelector(".attendance-add #classroom-report");
            if (lessonDate) {
              _context10.next = 5;
              break;
            }
            return _context10.abrupt("return", false);
          case 5:
            lessonDate.onchange = /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee9() {
              var scheduleId, lesson_date, schedulesPromise, res;
              return _regeneratorRuntime().wrap(function _callee9$(_context9) {
                while (1) switch (_context9.prev = _context9.next) {
                  case 0:
                    scheduleId = schedule.value;
                    if (scheduleId) {
                      _context9.next = 4;
                      break;
                    }
                    $("#toast-error .toast-body").html("Vui lòng chọn lịch dạy");
                    return _context9.abrupt("return", $("#toast-error").toast("show"));
                  case 4:
                    lesson_date = lessonDate.value;
                    schedulesPromise = getStudentsBySchedule(scheduleId, lesson_date, classroom.value);
                    _context9.next = 8;
                    return schedulesPromise;
                  case 8:
                    res = _context9.sent;
                    setStudents(res);
                  case 10:
                  case "end":
                    return _context9.stop();
                }
              }, _callee9);
            }));
          case 6:
          case "end":
            return _context10.stop();
        }
      }, _callee10);
    }));
    return function handleLessons() {
      return _ref9.apply(this, arguments);
    };
  }();
  function setStudents(res) {
    var students = res.students;
    var lessonResult = res.lesson;
    var contentTable = document.querySelector("#content_table");
    var bodyTable = document.querySelector("#dataTable tbody");
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
    document.querySelector("#notification_table").style.display = "none";
    document.querySelector("#btn-save").style.display = "block";
    contentTable.style.display = "block";
    bodyTable.innerHTML = "";
    var attendanceChecked = [];
    students.forEach(function (e, index) {
      var contentTr = "<tr data-id=\"".concat(e.id, "\" data-code=\"").concat(e.code, "\">");
      contentTr += "<td class=\"text-center align-middle\">".concat(index + 1, "</td>");
      contentTr += "<td class=\"text-center align-middle\">".concat(e.code, "</td>");
      contentTr += "<td class=\"text-center align-middle\">".concat(e.full_name, "</td>");
      contentTr += "<td class=\"text-center align-middle\">";
      checkBoxArr.forEach(function (check) {
        contentTr += "<div class=\"form-check form-check-inline\">";
        contentTr += " <input class=\"form-check-input\" type=\"radio\" name=\"attendance-".concat(e.id, "\" id=\"attendance-").concat(e.id, "-").concat(check.value, "\" value=\"").concat(check.value, "\" required>");
        contentTr += "<label class=\"form-check-label\" for=\"attendance-".concat(e.id, "-").concat(check.value, "\">").concat(check.name, "</label>");
        contentTr += "</div>";
        if (e.attendance == check.value) {
          attendanceChecked.push("#" + "attendance-".concat(e.id, "-").concat(check.value));
        }
      });
      contentTr += "</td>";
      contentTr += "<td class=\"text-center align-middle\"></td>";
      contentTr += "</tr>";
      $(contentTr).appendTo("#dataTable tbody");
    });
    attendanceChecked.forEach(function (e) {
      $(e).prop("checked", true);
    });
    table.DataTable().columns.adjust();
  }
  $('.attendance #start_time').change(function () {
    var val = $(this).val();
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
  $('.attendance #end_time').change(function () {
    var val = $(this).val();
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
  $(document).on("click", "#submitAttendance", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee11() {
    var params, errors, lesson, schedule, classroom, scheduleId, classroomId, token, start_time, end_time, data;
    return _regeneratorRuntime().wrap(function _callee11$(_context11) {
      while (1) switch (_context11.prev = _context11.next) {
        case 0:
          params = [];
          errors = [];
          lesson = document.querySelector("#lesson_date");
          schedule = document.querySelector(".attendance-add #subject-report");
          classroom = document.querySelector(".attendance-add #classroom-report");
          scheduleId = schedule.value;
          classroomId = classroom.value;
          $("#dataTable tbody tr").each(function (index) {
            var studentId = $(this).data("id");
            var attendance = $(this).find("input[name=\"attendance-".concat(studentId, "\"]:checked")).val();
            if (attendance == undefined) {
              errors.push("Học viên " + $(this).data("code") + " chưa được điểm danh");
            } else {
              params.push({
                student_id: studentId,
                attendance: attendance
              });
            }
          });
          if (!errors.length) {
            _context11.next = 11;
            break;
          }
          $("#toast-error .toast-body").html("Vui lòng điểm danh học viên. " + errors[0]);
          return _context11.abrupt("return", $("#toast-error").toast("show"));
        case 11:
          token = $('meta[name="csrf-token"]').attr("content");
          start_time = $('#start_time').val();
          end_time = $('#end_time').val();
          _context11.next = 16;
          return axios.post("".concat(baseUrl, "/api/attendances/"), {
            students: params,
            start_time: start_time,
            end_time: end_time,
            lesson_date: lesson.value,
            schedule_id: scheduleId,
            classroom_id: classroomId
          }, {
            headers: {
              "Content-Type": "multipart/form-data",
              "X-CSRF-TOKEN": token
            }
          });
        case 16:
          data = _context11.sent;
          if (!data.data["status"]) {
            _context11.next = 19;
            break;
          }
          return _context11.abrupt("return", $("#toast-success").toast("show"));
        case 19:
        case "end":
          return _context11.stop();
      }
    }, _callee11);
  })));
  var handleLessonSchedule = /*#__PURE__*/function () {
    var _ref12 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee13() {
      var schedule;
      return _regeneratorRuntime().wrap(function _callee13$(_context13) {
        while (1) switch (_context13.prev = _context13.next) {
          case 0:
            schedule = document.getElementById("lesson-schedule");
            if (schedule && schedule.length) {
              schedule.addEventListener('change', /*#__PURE__*/function () {
                var _handleChange = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee12(event) {
                  var scheduleId, data, html;
                  return _regeneratorRuntime().wrap(function _callee12$(_context12) {
                    while (1) switch (_context12.prev = _context12.next) {
                      case 0:
                        scheduleId = event.target.value;
                        _context12.next = 3;
                        return axios({
                          method: "get",
                          url: "".concat(baseUrl, "/api/lessons/getItemsByScheduleToHtml/").concat(scheduleId),
                          responseType: "json"
                        });
                      case 3:
                        data = _context12.sent;
                        html = data.data;
                        table.DataTable().clear().draw();
                        $('#dataTable tbody').html(html);
                        table.DataTable().rows.add({});
                        table.DataTable().columns.adjust();
                      case 9:
                      case "end":
                        return _context12.stop();
                    }
                  }, _callee12);
                }));
                function handleChange(_x11) {
                  return _handleChange.apply(this, arguments);
                }
                return handleChange;
              }());
            }
          case 2:
          case "end":
            return _context13.stop();
        }
      }, _callee13);
    }));
    return function handleLessonSchedule() {
      return _ref12.apply(this, arguments);
    };
  }();
  var handleScheduleClassroom = /*#__PURE__*/function () {
    var _ref13 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee15() {
      var classroom;
      return _regeneratorRuntime().wrap(function _callee15$(_context15) {
        while (1) switch (_context15.prev = _context15.next) {
          case 0:
            classroom = document.getElementById("schedule-classroom");
            if (classroom && classroom.length) {
              classroom.addEventListener('change', /*#__PURE__*/function () {
                var _handleChange2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee14(event) {
                  var classroomId, data, html;
                  return _regeneratorRuntime().wrap(function _callee14$(_context14) {
                    while (1) switch (_context14.prev = _context14.next) {
                      case 0:
                        classroomId = event.target.value;
                        _context14.next = 3;
                        return axios({
                          method: "get",
                          url: "".concat(baseUrl, "/api/schedules/getItemsByClassroomToHtml/").concat(classroomId),
                          responseType: "json"
                        });
                      case 3:
                        data = _context14.sent;
                        html = data.data;
                        table.DataTable().clear().draw();
                        $('#dataTable tbody').html(html);
                        table.DataTable().rows.add({});
                        table.DataTable().columns.adjust();
                      case 9:
                      case "end":
                        return _context14.stop();
                    }
                  }, _callee14);
                }));
                function handleChange(_x12) {
                  return _handleChange2.apply(this, arguments);
                }
                return handleChange;
              }());
            }
          case 2:
          case "end":
            return _context15.stop();
        }
      }, _callee15);
    }));
    return function handleScheduleClassroom() {
      return _ref13.apply(this, arguments);
    };
  }();
  $(".select-multiple").selectpicker();
  $(".toast").toast({
    delay: 7000
  });
  handleData();
  handleAttendances();
  handleLessons();
  handleLessonSchedule();
  handleScheduleClassroom();
  var selectElement = document.querySelector(".report #subject");
  if (selectElement) {
    selectElement.addEventListener("change", /*#__PURE__*/function () {
      var _ref14 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee16(event) {
        var val, ctx, params, data, dynamicColors, dataChart, i, coloR, config;
        return _regeneratorRuntime().wrap(function _callee16$(_context16) {
          while (1) switch (_context16.prev = _context16.next) {
            case 0:
              val = event.target.value;
              $('.change-canvas').html('<canvas id="attendanceChart" class="canvas"></canvas>');
              ctx = document.getElementById('attendanceChart');
              params = {
                subject_id: val,
                classroom_id: $('#classroom').val()
              };
              _context16.next = 6;
              return axios({
                method: "post",
                url: "".concat(baseUrl, "/api/lessons/getReportItemsBySchedule/"),
                responseType: "json",
                data: params
              });
            case 6:
              data = _context16.sent;
              dynamicColors = function dynamicColors() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
              };
              dataChart = data.data;
              for (i in dataChart) {
                coloR = dynamicColors();
              }
              config = {
                type: 'bar',
                data: dataChart,
                options: {
                  responsive: true,
                  plugins: {
                    legend: {
                      position: 'top'
                    },
                    title: {
                      display: true,
                      text: 'Thống kê buổi học theo lịch học'
                    }
                  }
                }
              };
              new Chart(ctx, config);
            case 12:
            case "end":
              return _context16.stop();
          }
        }, _callee16);
      }));
      return function (_x13) {
        return _ref14.apply(this, arguments);
      };
    }());
  }
  var subjectReport = document.querySelector(".report #subject-report");
  if (subjectReport) {
    subjectReport.addEventListener("change", /*#__PURE__*/function () {
      var _ref15 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee17(event) {
        var val, classroomId, params, data, res, tableReport;
        return _regeneratorRuntime().wrap(function _callee17$(_context17) {
          while (1) switch (_context17.prev = _context17.next) {
            case 0:
              $('#content_table').html('<table class="table table-bordered" id="dataTableReport" width="100%" cellspacing="0"></table>');
              val = event.target.value;
              classroomId = $('#classroom-report').val();
              params = {
                subject_id: val,
                classroom_id: classroomId
              };
              _context17.next = 6;
              return axios({
                method: "post",
                url: "".concat(baseUrl, "/api/attendances/report"),
                responseType: "json",
                data: params
              });
            case 6:
              data = _context17.sent;
              res = data.data;
              if (res.body.length && res.head.length) {
                tableReport = $("#dataTableReport");
                tableReport.DataTable({
                  lengthChange: true,
                  info: true,
                  scrollX: true,
                  data: res.body,
                  columns: res.head
                });
                tableReport.DataTable().columns.adjust();
              } else {}
            case 9:
            case "end":
              return _context17.stop();
          }
        }, _callee17);
      }));
      return function (_x14) {
        return _ref15.apply(this, arguments);
      };
    }());
  }
  var classroomReport = document.querySelector("#classroom-report");
  if (classroomReport) {
    classroomReport.addEventListener("change", /*#__PURE__*/function () {
      var _ref16 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee18(event) {
        var val, data, res, subjectSelect;
        return _regeneratorRuntime().wrap(function _callee18$(_context18) {
          while (1) switch (_context18.prev = _context18.next) {
            case 0:
              val = event.target.value;
              _context18.next = 3;
              return axios({
                method: "get",
                url: "".concat(baseUrl, "/api/schedules/getItemsByClassroom/").concat(val),
                responseType: "json"
              });
            case 3:
              data = _context18.sent;
              res = data.data; // Xóa các phần tử <option> cũ
              subjectSelect = document.getElementById("subject-report");
              subjectSelect.innerHTML = "<option value=''>Chọn môn học...</option>";

              // Render dữ liệu vào các select
              res.forEach(function (subject) {
                var option = document.createElement("option");
                option.value = subject.id;
                option.textContent = subject.name;
                subjectSelect.appendChild(option);
              });
            case 8:
            case "end":
              return _context18.stop();
          }
        }, _callee18);
      }));
      return function (_x15) {
        return _ref16.apply(this, arguments);
      };
    }());
  }
  var attendanceSubject = document.querySelector(".attendance #subject-report");
  if (attendanceSubject) {}
})(jQuery); // End of use strict

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/scss/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=app.js.map