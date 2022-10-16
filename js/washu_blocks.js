// Edit the WU Standard Block when it appears

var washuBlocks = document.querySelectorAll('.wp-block-washu-card');

for (var i = 0; i < washuBlocks.length; i++) {
     // Identify structure
     var cardTitle = washuBlocks[i].querySelector('.washu-card__title');
     var cardContent = washuBlocks[i].querySelector('.washu-card__content');

     // Create new element
     var newCardGroupEl = document.createElement('div')
     newCardGroupEl.classList.add('washu-card__grouping');
     washuBlocks[i].appendChild(newCardGroupEl);

     // Build new structure
     var cardGroup = washuBlocks[i].querySelector('.washu-card__grouping');
     cardGroup.appendChild(cardTitle);
     cardGroup.appendChild(cardContent);
};