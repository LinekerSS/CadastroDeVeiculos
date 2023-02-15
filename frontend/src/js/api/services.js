export default {
    vehicles: {
        all: {
            method: 'GET',
            url: '/vehicles'
        },
        show: {
            method: 'GET',
            url: '/vehicles/show'
        },
        search: {
            method: 'GET',
            url: '/vehicles/find'
        },
        store: {
            method: 'POST',
            url: '/vehicles'
        },
        update: {
            method: 'POST',
            url: '/vehicles/update'
        },
        drop: {
            method: 'POST',
            url: '/vehicles/delete'
        }
    }
}