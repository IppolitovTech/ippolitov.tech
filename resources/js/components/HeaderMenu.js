export default {
    props: ["mainmenulinks", "currentlink",'portfoliowork', 'portfolioclose'],
    data: function () {
        return {
            urlFromDataBase: this.mainmenulinks,
            currentPage: "/",
            title: "Open journal system developer",
        };
    },
    mounted() {
        let self = this;
        this.mainmenulinks.forEach(function callback(currentValue) {
            if (currentValue.link == self.currentlink) {
                self.currentPage = currentValue.link;
                self.title = currentValue.title;
                self.putSlashInBrowserAddressBar(currentValue.link);
                document.title = currentValue.title;
            }
        });
    },
    methods: {
        getPage(link, urlFromDataBase) {
            this.title = urlFromDataBase.title;
            this.currentPage = link;
            document.title = this.title;
            this.putSlashInBrowserAddressBar(link);
        },
        putSlashInBrowserAddressBar(url) {
            if (url != "/") {
                history.pushState(null, null, "/" + url + "/");
            } else {
                history.pushState(null, null, "/");
            }
        },
    },
};
