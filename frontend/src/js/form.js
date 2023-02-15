import Http from './api/http'

export default class Form {

    constructor (id = '', service = '') {
        this.requests = new Http().request()
        this.el = document.querySelector(id)
    }

    serialize () {
        return new FormData(this.el)
    }

    async submit(service = '') {
        try {
            const response = await this.requests.vehicles[service](this.serialize())
            this.el.reset()
            return Promise.resolve(response)
        } catch (error) {
            return Promise.reject(error)
        }
    }

}