import Http from "./api/http";

export default class List {

    constructor () {
        this.requests = new Http().request().vehicles
        this.listIdentify = '#vehiclesList'
        this.detailsIdentify = '.vehicle-details'
        this.detailsEl = document.querySelector(this.detailsIdentify)
        this.el = document.querySelector(this.listIdentify)
        this.errorMessage = null
        this.data = null
    }

    getData () {
        return this.data
    }

    makeComponents (data) {
        return `
            <li 
                onclick="Vehicles.openDetails(${data['id']})"
            >
                <div class="vehicle-data">
                    <span class="manufacturer">${data['manufacturer']}</span>
                    <span class="vehicle">${data['vehicle']}</span>
                    <span class="year">${data['year']}</span>
                </div>
                <div class="icon">
                    ${data['deleted_at']? '<span>Deletado</span>' : '<i class="fas fa-bookmark"></i>'}
                </div>
            </li>
        `
    }

    noComponent(message) {
        return `
            <li class="no-data" onclick="Vehicles.load()">
                ${message}
            </li>
        `;
    }

    async requestAll () {
        try {
            return await this.requests.all()
        } catch (error) {
            console.error(error)
            this.errorMessage = JSON.parse(error.request.response).error
            return null
        }
    }

    async requestOne(id) {
        try {
            return await this.requests.show({ id })
        } catch (error) {
            console.error(error)
            this.errorMessage = JSON.parse(error.request.response).error
            return null
        }
    }

    async load() {
        const {data} = await this.requestAll()
        this.loadContent(data)
    }

    loadContent(data = []) {
        this.el.innerHTML = ''

        if(!data || !data.length) {
            this.el.innerHTML = this.noDataComponent(this.errorMessage)
            return null
        }

        this.data = data

        data.map(item => {
            this.el.innerHTML += this.makeComponent(item)
        })
    }

    loadPreviewInputs(data = {}) {
        Object.keys(data).forEach(key => {
            const el = document.querySelector(`[data-detail="${key}"]`)
            if(el) el.innerHTML = data[key]
        })
    }

    async openDetails (id) {

        loading.fire()

        const response = await this.requestOne(id)

        if(!response) {
            this.closeDetails()
            toast.fire({
                icon: "error",
                title: this.errorMessage,
            })
            return null;
        }

        this.loadPreviewInputs(response.data)

        this.detailsEl.classList.add('vehicle-details-show')

        document.querySelector('.btn-edit').dataset.id = id
        document.querySelector('.btn-drop').dataset.id = id

        document.querySelector('.page').scroll({ top: 100000, behavior: "smooth"})

        toast.fire({
            title: 'Veículo carregado!',
            icon: "success"
        })
    }

    closeDetails () {
        this.detailsEl.classList.remove('vehicle-details-show')
    }

}