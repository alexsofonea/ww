document.body.addEventListener('click', function(event) {
    // Stop the scroll
    document.body.style.overflow = 'hidden';

    // Create the element with class 'wwEditor'
    const wwEditor = document.createElement('div');
    wwEditor.className = 'wwEditWidget';

    // Set the position of the element to the mouse coordinates
    wwEditor.style.position = 'absolute';
    wwEditor.style.left = `${event.clientX}px`;
    wwEditor.style.top = `${event.clientY}px`;

    // Append the element to the body
    document.body.appendChild(wwEditor);
});