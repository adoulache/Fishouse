const interact = require('interactjs')

/* The dragging code for '.draggable' from the demo above
 * applies to this demo as well so it doesn't have to be repeated. */
$(function () {

// enable draggables to be dropped into this
    interact('.dropzone').dropzone({
        // only accept elements matching this CSS selector
        accept: '.yes-drop',
        // Require a 100% element overlap for a drop to be possible
        overlap: 1,

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
            $(draggableElement).appendTo( ".dropzone" );

            draggableElement.style.borderColor = 'blue';
            // keep the dragged position in the data-x/data-y attributes
            console.log(parseInt(draggableElement.getAttribute('data-x')))
            console.log(parseInt(draggableElement.getAttribute('data-y')))

        },
        ondropdeactivate: function (event) {
            // remove active dropzone feedback
            event.target.classList.remove('drop-active')
            event.target.classList.remove('drop-target')
        }
    })

    interact('.yes-drop')
        .draggable({
            inertia: true,
            /*modifiers: [
                interact.modifiers.restrictRect({
                    restriction: '#mod2D',
                    endOnly: true
                })
            ],*/
            autoScroll: true,
            // dragMoveListener from the dragging demo above
            listeners: {move: dragMoveListener}
        }).on('move', function (event) {
        let interaction = event.interaction;
        if (interaction.pointerIsDown && !interaction.interacting() && event.currentTarget.getAttribute('clonable') !== 'false') {
            let original = event.currentTarget;
            let clone = original.childNodes[1].cloneNode(true);
            clone.classList.add("yes-drop");
            clone.classList.add("clonedItem");
            //let x = clone.offsetLeft;
            //let y = clone.offsetTop;
            clone.setAttribute('clonable', 'false');
            //clone.style.position = "absolute";
            //clone.style.left = original.offsetLeft + "px";
            //clone.style.top = original.offsetTop + "px";
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
