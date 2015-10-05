/**
 * Created by Shade on 9/25/15.
 */
var winSound = new Audio('misc/win.mp3');
var games = Number($('#games').text());
var clicked = false;
var prize = 0;

$('td').one('click',function(){
    var self = $(this);
    var row = self.parent();
    var col = $('td[data-col="' + self.attr('data-col') + '"]');

    self.find('span').fadeIn();
    checkForCombo(row);
    checkForCombo(col);
    registerTry();
});

function checkForCombo(element){
    var cells = element.find('td').length ? element.find('td') : element;
    var hidden = cells.find('span:hidden');

    if(hidden.length == 0) {
        for (var i = 1; i <= 5; i++) {
            if(cells.find('span.'+i).length == cells.length) {
               registerCombo();
            }
        }
    }

    if($('span:hidden').length == 0) {
           location.reload();
    }
}

function registerCombo(){
    prize += 5;
    winSound.play();

    $('#prize').text(prize);
    updateRecords({'amount' : prize});
}

function registerTry(){
    if(!clicked) {
        clicked = true;

        $('#games').text(--games);
        updateRecords({'games' : games});
    }
}

function updateRecords(data) {
    $.post("ajax.php", data)
        .done(function( data ) {
            return data;
    });
}