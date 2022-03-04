if (document.querySelector('.single-post') !== null) {
    let heads = document.querySelectorAll('article h2, article h3, article h4, article h5, article h6')

    heads.forEach(head => {
        head.id = head.innerHTML
    })

    let ul = document.querySelector('.article-headings')

    heads.forEach(head => {
        let heading = document.createElement("li")
        heading.innerHTML = `<a href="#${head.innerHTML}">${head.innerHTML}</a>`

        ul.append(heading)

    })
}

