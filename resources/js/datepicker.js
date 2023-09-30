$(function() {
  'use strict';

  if($('#datePickerExample').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#datePickerExample').datepicker({
      format: "mm/dd/yyyy",
      todayHighlight: true,
      autoclose: true
    });
    $('#datePickerExample').datepicker('setDate', today);
  }

    if($('#couponExpiryDatePicker').length) {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#couponExpiryDatePicker').datepicker({
            format: "yyyy/mm/dd",
            todayHighlight: true,
            startDate: today,
            autoclose: true
        });
         $('#couponExpiryDatePicker').datepicker('setDate', new Date($('#coupon-expiry-date').val()));
    }

});