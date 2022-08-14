import * as React from 'react';
import {useEffect,useState} from 'react';
import Link from '@mui/material/Link';
import Typography from '@mui/material/Typography';
import Title from '../Title/Title';
import Grid from '@mui/material/Grid';
import Paper from '@mui/material/Paper';
import axios from 'axios';

function preventDefault(event) {
    event.preventDefault();
}

export default function GasDeposite() {

    const [sensor,setSensor] = useState();

    useEffect(() => {
        axios.get(`http://home-ems.herokuapp.com/api/gas/consumption/current_consumption`,
            { headers: { "Authorization": `Bearer ${localStorage.getItem('hems_token')}` } })
            .then(data => {
                // console.log('data sensor',data.data.sensor);
                setSensor(data.data.sensor);
                // setChartData(data.data['0']);
                console.log('data xxx', data.data)
            })
            .catch(error => {
                // setErrorMessage('ليس هنالك اي مستخدمين بهذه المعلومات')
                // console.log('erro while logging in',error);
            })
            .finally(() => {

            })
        setInterval(() => {

            axios.get(`http://home-ems.herokuapp.com/api/gas/consumption/current_consumption`,
                { headers: { "Authorization": `Bearer ${localStorage.getItem('hems_token')}` } })
                .then(data => {
                    // console.log('data sensor',data.data.sensor);
                    setSensor(data.data.sensor);
                    // setChartData(data.data['0']);
                })
                .catch(error => {
                    // setErrorMessage('ليس هنالك اي مستخدمين بهذه المعلومات')
                    // console.log('erro while logging in',error);
                })
                .finally(() => {

                })
        }, 60000);

    }, [])
    return (
        <Grid item xs={12} md={4} lg={3}>
            <Paper
                sx={{
                    p: 2,
                    display: 'flex',
                    flexDirection: 'column',
                    minHeight: 240,
                }}
            >
        <div style={{ display: 'flex', width: '100%', height: '100%', flexDirection: 'column', justifyContent: 'space-between' }}>
            
            
                    <Typography component="p" variant="">Current Consumption</Typography>
                    <div style={{ marginTop: '15px' }}/>
                    <Typography component="p" variant="h5" sx={{ color: 'green', marginBottom: '15px' }}>
                        {sensor?.current_consumption} kWh
                    </Typography>{/* <Typography component="p" variant="">Current Consumption</Typography>
            <Typography component="p" variant="h5" sx={{ color: 'green', marginBottom: '15px' }}>
                {sensor?.current_consumption} kWh
            </Typography>

            <Typography component="p" variant="">Current Voltage</Typography>
            <Typography component="p" variant="h5" sx={{ color: 'green', marginBottom: '15px' }}>
                {sensor?.current_voltage} V
            </Typography>

            <Typography component="p" variant="">Current Cost</Typography>
            <Typography component="p" variant="h5" sx={{ color: 'green' }}>
                {sensor?.current_consumption * 40} s.p
            </Typography> */}

            <div>
                {/* <Link color="primary" href="#" onClick={preventDefault}>
          
        </Link> */}
            </div>
        </div>
        </Paper>
        </Grid>
    );
}