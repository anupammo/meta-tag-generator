document.addEventListener("DOMContentLoaded", () => {
    // Set up page title and URL in inputs, if they exist.
    const pageTitleElem = document.getElementById("pageTitle");
    const urlElem = document.getElementById("url");
    if (pageTitleElem) {
      pageTitleElem.value = document.title;
    }
    if (urlElem) {
      urlElem.value = window.location.href;
    }
  
    // Auto-fetch featured image from the WordPress meta tag field.
    const featuredImageElem = document.getElementById("mtg_meta_image");
    if (featuredImageElem && !featuredImageElem.value) {
      const wpFeaturedImage = document.querySelector("meta[property='og:image']");
      featuredImageElem.value = wpFeaturedImage ? wpFeaturedImage.getAttribute("content") : "";
    }
  });
  
  function generateMetaTags() {
    // Retrieve values from form fields with fallback to empty strings.
    const pageTitle = (document.getElementById("pageTitle")?.value.trim() || "");
    const metaDescription = (document.getElementById("metaDescription")?.value.trim() || "");
    const url = (document.getElementById("url")?.value.trim() || "");
    const ogImage = (document.getElementById("mtg_meta_image")?.value.trim() || "");
    const ogType = (document.getElementById("mtg_og_type")?.value.trim() || "");
    const twitterCard = (document.getElementById("mtg_twitter_card")?.value.trim() || "");
  
    // Start generating meta tags.
    let metaTags = `<!-- Primary Meta Tags -->\n`;
    metaTags += `<title>${pageTitle}</title>\n`;
    metaTags += `<meta name="description" content="${metaDescription}">\n`;
    metaTags += `<link rel="canonical" href="${url}">\n`;
  
    metaTags += `\n<!-- Open Graph / Facebook -->\n`;
    metaTags += `<meta property="og:type" content="${ogType}">\n`;
    metaTags += `<meta property="og:url" content="${url}">\n`;
    metaTags += `<meta property="og:title" content="${pageTitle}">\n`;
    metaTags += `<meta property="og:description" content="${metaDescription}">\n`;
    metaTags += `<meta property="og:image" content="${ogImage}">\n`;
  
    metaTags += `\n<!-- Twitter -->\n`;
    metaTags += `<meta property="twitter:card" content="${twitterCard}">\n`;
    metaTags += `<meta property="twitter:url" content="${url}">\n`;
    metaTags += `<meta property="twitter:title" content="${pageTitle}">\n`;
    metaTags += `<meta property="twitter:description" content="${metaDescription}">\n`;
    metaTags += `<meta property="twitter:image" content="${ogImage}">\n`;
  
    // Create Schema Markup (JSON-LD) dynamically.
    const jsonLD = {
      "@context": "https://schema.org",
      "@type": ogType === "article" ? "Article" : "WebPage",
      "name": pageTitle,
      "url": url,
      "description": metaDescription,
      "image": ogImage
    };
  
    metaTags += `\n<script type="application/ld+json">`;
    metaTags += JSON.stringify(jsonLD, null, 2);
    metaTags += `</script>\n`;
  
    // Output the generated meta tags, if the output element exists.
    const outputElem = document.getElementById("output");
    if (outputElem) {
      outputElem.value = metaTags;
    }
  }
  
  function copyToClipboard() {
    const outputElem = document.getElementById("output");
    if (outputElem && outputElem.value) {
      navigator.clipboard.writeText(outputElem.value)
        .then(() => alert("Meta tags copied!"))
        .catch(err => console.error("Failed to copy:", err));
    } else {
      console.error("Output element is missing or empty.");
    }
  }
  
