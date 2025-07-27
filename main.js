function onLoad() {
    const button = document.querySelector('.nav-button')
    const nav = document.querySelector('.product-nav')
    // add listener for click on button
    button.addEventListener('click', function(){
        if( nav.classList.contains('open') ) {
            nav.classList.remove('open')
        }
        else {
            nav.classList.add('open')
        }
    } )
    // search form
    const search = document.querySelector("#search-form")
    search.addEventListener('submit', function(event) {
        const data = new FormData(event.target)
        if( ! data.get("query") ) {
            alert("type a search query")
        }
    })
}

window.addEventListener('load', onLoad )