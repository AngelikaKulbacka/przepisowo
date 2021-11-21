function readUrl(input) {
    console.log(input.files[0]);
    let imgName = input.files[0].name;
    input.setAttribute("data-title", imgName);
}

$(document).ready(function() {
    $('#addStep').click(function() {
        let before = $('.stepClone').prev();
        if (before.find('textarea').val() != '') {
            $('.stepClone').clone().removeClass('stepClone').insertBefore('.stepClone').show().find('textarea').attr('name', 'steps[]');
        }

    });


    $('#removeStep').click(function() {
        let steps = $('textarea[name="steps\[\]"]');
        if (steps.length != 1) {
            $('.stepClone').prev().remove();
        }
    });

    $('#addIngredient').click(function() {
        let before = $('#ingredientClone').prev();
        if (before.find('input').val() != '') {
            let element = $('#ingredientClone').clone().removeClass('d-none').attr('id', '').insertBefore("#ingredientClone").show();
            element.find('input').attr('name', 'ingredient[]');
            
            element.find('#number').text(parseInt(element.prev().find('#number').text()) + 1);
        }
    });


    $('#removeIngredient').click(function() {
        let element = $('#ingredientClone').prev();

        if(element.find('#number').text() != '1') {
            element.remove();
        }
    });

    $('#serch-add-ingredient').click(function() {
        skladnik = $("#search-ingredient-input").val();
        console.log(skladnik);
        if(skladnik && skladnik != "") {
            element = $("#clone-card").clone().removeAttr("id").insertBefore("#clone-card").show();
            element.find("input").attr("name", "skladniki[]").removeAttr("id").val(skladnik);
            element.find("label").removeAttr("id").text(skladnik);
        }
        $("#search-ingredient-input").val("");
    });

    $('.star-editable').hover(function() {
        ocena = parseInt($(this).attr("id").replace("star-", ""));
        for(i=1; i<=ocena; i++) {
            $('#star-'+i).find("i").removeClass("far").addClass("fas").css("color", "#ff5757");
        }
        for(i=ocena+1; i<=5; i++) {
            $('#star-'+i).find("i").removeClass("fas").addClass("far").css("color", "white");
        }
    });

    $('.removeUserShare').click(function(){
        remove(this);
    })

    function remove(obj) {
        $(obj).parent().parent().remove();

        if($('#addedUsers').children().length <= 2) {
            $('#addedUsers').addClass('d-none');
        }
    }
    
    $('#addUserShare').click(function(){
        let newEmail = $('#share').val();
        if (newEmail != '') {
            $('#addedUsers').removeClass('d-none');
            let cloned  = $('#shareClone').clone().removeClass('d-none').attr('id', '');
            cloned.find('input').attr('disabled', false).attr('readonly', 'readonly').val(newEmail);
            $('#share').val('');
            cloned.find('.removeUserShare').click(function(){
                remove(this);
            });
            cloned.insertBefore('#shareClone');
        }
    });
});
