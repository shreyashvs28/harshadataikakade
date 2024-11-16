function trimTrailingSlash(string) {
    // Remove trailing slashes from the given string
    if (string != null) {
        return string.replace(/\/+$/, '');
    }
    return string;
}

// Polyfill for `String.prototype.trim` to support older browsers
if (!String.prototype.trim) {
    String.prototype.trim = function() {
        return this.replace(/^\s+|\s+$/g, '');
    };
}

// Initialize variables for counter URLs
const ctrHref = trimTrailingSlash('http://www.freevisitorcounters.com'.trim());
const ctrHref2 = trimTrailingSlash('http://www.freevisitorcounters.com'.trim());

// Function to check if an element exists within the document
function eInDoc(e) {
    while (e) {
        e = e.parentNode;
        if (e === document) {
            return true;
        }
    }
    return false;
}

// Function to validate a link element
function lCheck(l) {
    if (
        l != null &&
        l.getAttribute('href') != null &&
        (ctrHref === '' ||
            trimTrailingSlash(l.getAttribute('href').trim()) === ctrHref ||
            trimTrailingSlash(l.href.trim()) === ctrHref ||
            trimTrailingSlash(l.getAttribute('href').trim()) === ctrHref2 ||
            trimTrailingSlash(l.href.trim()) === ctrHref2)
    ) {
        return true;
    }
    return false;
}

// Main logic for checking the presence of a valid counter link
window.onload = function() {
    const els = document.getElementsByTagName('a'); // Get all anchor tags
    let linkfound = false;

    for (let i = 0; i < els.length; i++) {
        const el = els[i];

        // Check if the link matches the expected counter URL
        if (
            trimTrailingSlash(el.href) === ctrHref ||
            trimTrailingSlash(el.getAttribute('href')) === ctrHref ||
            trimTrailingSlash(el.href) === ctrHref2 ||
            trimTrailingSlash(el.getAttribute('href')) === ctrHref2
        ) {
            linkfound = true;

            // Perform additional checks to validate the link
            if (
                el.getAttribute('rel') === 'nofollow' ||
                !eInDoc(el) ||
                !lCheck(el) ||
                !el.innerHTML || // Check for undefined or empty innerHTML
                el.innerHTML.trim() === '' ||
                (el.offsetHeight != null && el.offsetHeight < 8) // Check if the link is visible
            ) {
                linkfound = false;
            }

            // Exit loop if a valid link is found
            if (linkfound) break;
        }
    }

    // Handle the case where no valid link is found
    if (!linkfound) {
        const div = document.createElement('div');
        div.id = 'error_5ec09fc8c4e3e633c6c943a1a9b04b0b368d8d4e';
        div.innerHTML =
            '<a href="https://www.freevisitorcounters.com/en/home/countercode/hashid/?id=5ec09fc8c4e3e633c6c943a1a9b04b0b368d8d4e">Counter Error: Do not change the code. Click here to show the correct code!</a>';

        const counterImg = document.getElementById('counterimg');
        if (counterImg != null) {
            counterImg.parentNode.insertBefore(div, counterImg.nextSibling);
        } else {
            document.body.appendChild(div);
        }

        if (counterImg) {
            counterImg.style.visibility = 'hidden';
        }
    }
};
