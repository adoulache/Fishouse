const interact = require('interactjs')

/* The dragging code for '.draggable' from the demo above
 * applies to this demo as well so it doesn't have to be repeated. */
$(function () {

// enable draggables to be dropped into this
    interact('.dropzone').dropzone({
        // only accept elements matching this CSS selector
        accept: '.clonedItem',
        // Require a 80% element overlap for a drop to be possible
        overlap: 0.8,

        // listen for drop related events:

        ondropactivate: function (event) {
            // add active dropzone feedback
            event.target.classList.add('drop-active')
        },
        ondragenter: function (event) {
            let draggableElement = event.relatedTarget
            let dropzoneElement = event.target

            // feedback the possibility of a drop
            dropzoneElement.classList.add('drop-target')
            draggableElement.classList.add('can-drop')
            //draggableElement.textContent = 'Dragged in'
        },
        ondragleave: function (event) {
            // remove the drop feedback style
            event.target.classList.remove('drop-target')
            event.relatedTarget.classList.remove('can-drop')
            //event.relatedTarget.textContent = 'Dragged out'
        },
        ondrop: function (event) {
            let draggableElement = event.relatedTarget
            $(draggableElement).appendTo(".dropzone");

            console.log($(draggableElement).position().top);
            console.log($(draggableElement).position().left);

        },
        ondropdeactivate: function (event) {
            // remove active dropzone feedback
            event.target.classList.remove('drop-active')
            event.target.classList.remove('drop-target')
        }
    })

    interact('.clonedItem')
        .draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: '.tab-content',
                    endOnly: true
                })
            ],
            autoScroll: true,
            // dragMoveListener from the dragging demo above
            listeners: {move: dragMoveListener}
        });

    interact('.yes-drop')
        .draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: '.tab-content',
                    endOnly: true
                })
            ],
            autoScroll: true,
            // dragMoveListener from the dragging demo above
            listeners: {move: dragMoveListener}
        }).on('move', function (event) {
        let interaction = event.interaction;
        if (interaction.pointerIsDown && !interaction.interacting() && event.currentTarget.getAttribute('clonable') !== 'false') {
            let original = event.currentTarget;
            let clone = original.cloneNode(true);
            clone.classList.remove("newObjectPicture");
            clone.classList.remove("yes-drop");
            clone.classList.add("clonedItem");
            clone.setAttribute('clonable', 'false');
            clone.style.position = "absolute";
            clone.style.width = "200px";
            clone.style.height = "200px";
            clone.style.zIndex = "100";
            original.parentElement.appendChild(clone);
            interaction.start({name: 'drag'}, event.interactable, clone);
        }
    });

    function dragMoveListener(event) {
        let target = event.target
        // keep the dragged position in the data-x/data-y attributes
        let x = (parseInt(target.getAttribute('data-x')) || 0) + event.dx
        let y = (parseInt(target.getAttribute('data-y')) || 0) + event.dy

        // translate the element
        target.style.webkitTransform =
            target.style.transform =
                'translate(' + x + 'px, ' + y + 'px)'

        // update the posiion attributes
        target.setAttribute('data-x', x)
        target.setAttribute('data-y', y)
    }

    // this function is used later in the resizing and gesture demos
    window.dragMoveListener = dragMoveListener

});
