<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody>
        <tr :class="{success: id == current}" v-for="(sensor, key) in sortedUsers">
            <td>{{ ++key }}</td>
            <td>{{ sensor.current_consumption }}</td>
            <td>{{ sensor.current_voltage }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                users: []
            }
        },
        created() {
            this.fetchLeaderboard();
            this.listenForChanges();
        },
        methods: {
            fetchLeaderboard() {
                axios.get('/sensor/showSensor').then((response) => {
                    this.users = response.data;
                })
            },
            listenForChanges() {
                Echo.channel('channel-name')
                .listen('OverConsumption', (e) => {
                    var sensor = this.sensor.find((sensor) => sensor.id === e.id);
                        // check if user exists on leaderboard
                        if(sensor){
                            var index = this.sensor.indexOf(sensor);
                            this.sensor[index].current_consumption = e.current_consumption;
                        }
                        // if not, add 'em
                        else {
                            this.sensor.push(e)
                        }
                    })
            }
        },
        computed: {
            sortedUsers() {
                return this.sensor.sort((a,b) => b.current_consumption - a.current_consumption)
            }
        }
    }
</script>
