$('input.size-input').focusout(function() {
    console.log($(this).val());
    if (Number($(this).data('size')) < Number($(this).val())) {
        $(this).val($(this).data('size'));
        alert('Погрызанное яблоко нельзя увеличить');
    }
});