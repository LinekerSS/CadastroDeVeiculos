import Http from './api/http'

export default class Search
{
    constructor() {
        this.searchIdentify = ".search"
        this.searchShowClass = "search-show"
        this.el = document.querySelector(this.searchIdentify)
        this.requests = new Http().request()
    }

    hasOpen () {
        return this.el.classList.contains(this.searchShowClass)
    }

    open () {
        this.el.classList.add(this.searchShowClass)
    }

    close () {
        this.el.classList.remove(this.searchShowClass)
    }

    change () {
        if(this.hasOpen()) this.close()
        else this.open()
    }

    async execute() {
        this.close()
        try {
            loading.fire()
            const q = this.el.querySelector('input').value
            const {data} = await this.requests.vehicles.search({ q })
            Vehicles.loadContent(data)
            loading.close()
        } catch (error) {
            Vehicles.errorMessage = JSON.parse(error.request.response).error
            Vehicles.loadContent([])
            loading.close()
            console.log(error)
        }
    }
}