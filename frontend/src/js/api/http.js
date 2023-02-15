import axios from 'axios'
import services from './services'

export default class Http {

    constructor() {
        this.axios = axios.create({
            baseURL: 'http://localhost:3000'
        })

        this.services = services

        return this
    }

    makeGetURl(uri = '', data = null) {
        if (!data) return uri

        let response = '?'
        const keys = Object.keys(data)
        keys.map((key, index) => {
            response += `${key}=${data[key]}`
            if (index + 1 < keys.length) response += '&'
        })
        return `${uri}${response}`
    }

    request() {

        const modules = Object.keys(this.services)

        let requests = {}

        modules.map(module => {

            requests[module] = {}

            const services = Object.keys(this.services[module])

            services.map(service => {

                const serviceData = this.services[module][service]

                requests[module][service] = (data = {}) => {

                    const isGet = () => {
                        return serviceData.method.toUpperCase() === 'GET'
                    }

                    const url = isGet() ? this.makeGetURl(serviceData.url, data) : serviceData.url

                    return this.axios({
                        url,
                        method: serviceData.method,
                        data: isGet() ? null : data,
                        responseType: 'json'
                    })

                }

            })

        })

        return requests

    }

}
