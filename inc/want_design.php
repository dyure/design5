<?php global $d5_options; ?>
<script>
    function check() {
        if ($('.input_phone').val() != '') {
            $('.want_design_form_button').removeAttr('disabled');
        } else {
            $('.want_design_form_button').attr('disabled', 'disabled');
        }
    }
</script>
<div class="want_design">
    <div class="want_design_body">
        <div class="want_design_body_title">
            <?php echo $d5_options['d5_misc_field_2']; ?>
        </div>
        <div class="want_design_body_form">
            <form id="send_letter" class="want_design_form">
                <div class="input_control">
                    <label for="fldName" id="fldName_label">Имя</label>
                    <input type="text" name="fldName" class="input_name" id="fldName" autocomplete="off">
                </div>
                <div class="input_control">
                    <label for="fldPhone" id="fldPhone_label">Телефон*</label>
                    <input type="tel" name="fldPhone" class="input_phone" id="fldPhone" autocomplete="off" required onkeyup="check();">
                </div>
                <p>Нажимая кнопку вы даете согласие на обработку персональных данных</p>
                <div>
                    <input class="want_design_form_button" type="submit" disabled="disabled" value="Отправить">
                </div>
            </form>
        </div>
    </div>
</div>
