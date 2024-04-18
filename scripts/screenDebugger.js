// Function to get Bootstrap's current screen size
function getBootstrapScreenSize() {
    const width = window.innerWidth;
    if (width < 576) {
        return 'xs';
    } else if (width >= 576 && width < 768) {
        return 'sm';
    } else if (width >= 768 && width < 992) {
        return 'md';
    } else if (width >= 992 && width < 1200) {
        return 'lg';
    } else {
        return 'xl';
    }
}

// Update screen size display on page load and resize
function updateScreenSizeDisplay() {
    const screenSize = getBootstrapScreenSize();
    console.log('boker');
    let screenSizeDisplay = document.getElementById('screenSizeDisplay');
    if (!screenSizeDisplay) {
        screenSizeDisplay = document.createElement('div');
        screenSizeDisplay.id = 'screenSizeDisplay';
        document.body.appendChild(screenSizeDisplay);
        screenSizeDisplay.style.position = 'fixed';
        screenSizeDisplay.style.top = '10px';
        screenSizeDisplay.style.right = '10px';
        screenSizeDisplay.style.color = 'red';
    }
    screenSizeDisplay.innerText = 'Current Bootstrap Screen Size: ' + screenSize;
}

// Call the function when the page loads and when the window resizes
window.addEventListener('load', updateScreenSizeDisplay);
window.addEventListener('resize', updateScreenSizeDisplay);

