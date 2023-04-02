async function getLastFiveNewsletters() {
    try {
        const response = await fetch("http://localhost:8888/api/newsletters/lastfive");
        const data = await response.json();
        renderNewsletters(data);
    } catch (error) {
        console.log(error);
    }
}

function getNewsletterIDs(newsletters) {
    let newsletterIDs = [];

    for (let i = 0; i < newsletters.length; i++) {
        if (!newsletterIDs.includes(newsletters[i].NewsletterID)) {
            newsletterIDs.push(newsletters[i].NewsletterID);
        }
    }

    return newsletterIDs;
}

function renderNewsletters(newsletters) {
    let newsletterIDs = getNewsletterIDs(newsletters);

    const body = document.querySelector(".body");


    for (let id of newsletterIDs) {
        let articles = newsletters.filter(newsletter => newsletter.NewsletterID === id)
        count = 0;

        const divContainer = document.createElement("div");
        divContainer.className = "card display-card";

        const section = document.createElement("section");
        section.className = "newsletter-info";
        divContainer.appendChild(section);

        const newsletterRow = document.createElement("div");
        newsletterRow.className = "row";
        section.appendChild(newsletterRow);
        
        const newsletterTextDiv = document.createElement("div");
        newsletterTextDiv.className = "col text-center";
        newsletterRow.appendChild(newsletterTextDiv);

        const newsletterLogo = document.createElement("img");
        newsletterLogo.className = "newsletter-logo";
        newsletterLogo.src = articles[0].Logo;
        newsletterTextDiv.appendChild(newsletterLogo);

        const newsletterTitle = document.createElement("h2");
        newsletterTitle.textContent = articles[0].NewsletterTitle;
        newsletterTitle.className = "newsletter-title";
        newsletterTextDiv.appendChild(newsletterTitle);

        const newsletterDate = document.createElement("h3");
        newsletterDate.textContent = `Newsletter #${articles[0].NewsletterID} - ${new Date(articles[0].Date).toLocaleString('en-us',{month:'long', day:'numeric', year:'numeric'})}`;
        newsletterTextDiv.appendChild(newsletterDate);

        body.appendChild(divContainer);
        for (let item of articles) {
            count++;

            const article = document.createElement("article");

            const h3 = document.createElement("h3");
            h3.className = "text-center"
            h3.textContent = `${count}. ${item.ArticleTitle}`;
            article.appendChild(h3);

            const section = document.createElement("section");
            section.className = "row";
            article.appendChild(section);

            const divColumn = document.createElement("div");
            divColumn.className = "col";
            section.appendChild(divColumn);

            if (item.Image !== null) {
                const divImage = document.createElement("div");

                if (item.ImagePlacement === "Left") {
                    divImage.className = "float-start pe-4 img-container";
                } else if (item.ImagePlacement === "Right") {
                    divImage.className = "float-end ps-4 img-container";
                }

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
            divContainer.appendChild(article);
        }
    }
}

getLastFiveNewsletters();