async function getLastFiveNewsletters() {
    try {
        const response = await fetch("http://localhost:8888/api/newsletters/lastfive");
        const data = await response.json();
        console.log(data);
        renderLastActiveNewsletter(data);
    } catch (error) {
        console.log(error);
    }
}

function renderLastActiveNewsletter(newsletters) {
    newsletters = newsletters.filter(item => item.NewsletterID === newsletters[0].NewsletterID);

    const container = document.querySelector(".container");
    document.querySelector(".newsletter-logo").src = newsletters[0].Logo;
    document.querySelector(".newsletter-title").textContent = newsletters[0].NewsletterTitle;
    document.querySelector(".newsletter-id-date").textContent = `Newsletter #${newsletters[0].NewsletterID} - ${newsletters[0].Date}`;

    count = 0;

    for (let item of newsletters) {
        count++;
    
        const article = document.createElement("article");

        const h2 = document.createElement("h2");
        h2.className = "text-center"
        h2.textContent = `${count}. ${item.ArticleTitle}`;
        article.appendChild(h2);

        const section = document.createElement("section");
        section.className = "row";
        article.appendChild(section);

        const divColumn = document.createElement("div");
        divColumn.className = "col";
        section.appendChild(divColumn);

        if (item.Image !== null) {
            const divImage = document.createElement("div");

            if (item.ImagePlacement === "Left") {
                divImage.className = "float-start pe-4";
            } else if (item.ImagePlacement === "Right") {
                divImage.className = "float-end ps-4";
            }

            divImage.style = "max-width: 20%";
            divColumn.appendChild(divImage);

            const articleImage = document.createElement("img");
            articleImage.src = item.Image;
            articleImage.className = "article-image";
            divImage.appendChild(articleImage);
        }

        const divDescription = document.createElement("div");
        const p = document.createElement("p");
        p.textContent = item.Description;
        divColumn.appendChild(divDescription);
        divDescription.appendChild(p);
        container.appendChild(article);
    }

}

getLastFiveNewsletters();