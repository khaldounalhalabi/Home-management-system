import * as React from 'react';
import {useState,useEffect} from 'react';
import ListItemButton from '@mui/material/ListItemButton';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import ListSubheader from '@mui/material/ListSubheader';
import DashboardIcon from '@mui/icons-material/Dashboard';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import PeopleIcon from '@mui/icons-material/People';
import BarChartIcon from '@mui/icons-material/BarChart';
import LayersIcon from '@mui/icons-material/Layers';
import AssignmentIcon from '@mui/icons-material/Assignment';
import RoomIcon from '@mui/icons-material/Room';
import { Link } from 'react-router-dom';
import PropaneIcon from '@mui/icons-material/Propane';
import WaterIcon from '@mui/icons-material/Water';
import ElectricBoltIcon from '@mui/icons-material/ElectricBolt';
import Box from '@mui/material/Box';
import Grid from '@mui/material/Grid';
import TextField from '@mui/material/TextField';
import Title from '../../components/Title/Title';
import Container from '@mui/material/Container';
import MainContainer from '../MainContainer/MainContainer';
import Button from '@mui/material/Button';
import axios from 'axios';
import CircularProgress from '@mui/material/CircularProgress';

export default function Settings (){
    const [eleState,setEleState] = useState();
    const [allowed_consumption,setAllowed_consumption] = useState('');
  const [allowedcost,setAllowedCost] = useState('');
    const [allowedLoading,setAllwedLoading] = useState(false);
    const [costLoading,setCostLoading] = useState(false);
  

    useEffect(() => {

    axios.get(`http://home-ems.herokuapp.com/api/sensor/get`, 
    {headers: {"Authorization": `Bearer ${localStorage.getItem('hems_token')}`}})
    .then(data => {
      // console.log('data sensor',data.data.sensor);
      setEleState(data.data.sensor);
      setAllowed_consumption(data.data.sensor.allowed_consumption)
      // setChartData(data.data['0']);
    })
    .catch(error => {
      // setErrorMessage('ليس هنالك اي مستخدمين بهذه المعلومات')
      // console.log('erro while logging in',error);
    })
    .finally(() => {

    })


    },[]);


    const handleSubmit = (event) => {

      event.preventDefault();
      setAllwedLoading(true);

      axios.post(`http://home-ems.herokuapp.com/api/sensor/allowed_consumption?allowed_consumption=${allowed_consumption}`, {},
        { headers: { "Authorization": `Bearer ${localStorage.getItem('hems_token')}`, "Accept": "application/json" } })
        .then(data => {
          // console.log('data sensor',data.data.sensor);
          // setEleState(data.data.sensor);
          // setAllowed_consumption(data.data.sensor.allowed_consumption)
          // setChartData(data.data['0']);
          console.log('xxxxx')
        })
        .catch(error => {
          // setErrorMessage('ليس هنالك اي مستخدمين بهذه المعلومات')
          // console.log('erro while logging in',error);
          console.log('yyyyyyyy')
        })
        .finally(() => {
          setAllwedLoading(false)
        })

    }

  const handlecost = (event) => {
    event.preventDefault();
    setCostLoading(true);

    axios.post(`http://home-ems.herokuapp.com/api/sensor/allowed_consumption_coast?allowed_consumption_cost=${allowedcost}`, {},
      { headers: { "Authorization": `Bearer ${localStorage.getItem('hems_token')}`, "Accept": "application/json" } })
      .then(data => {
        // console.log('data sensor',data.data.sensor);
        // setEleState(data.data.sensor);
        // setAllowed_consumption(data.data.sensor.allowed_consumption)
        // setChartData(data.data['0']);
        console.log('xxxxx')
      })
      .catch(error => {
        // setErrorMessage('ليس هنالك اي مستخدمين بهذه المعلومات')
        // console.log('erro while logging in',error);
        console.log('yyyyyyyy')
      })
      .finally(() => {
        setCostLoading(false)
      })
  } 

  const handleAllowChange = (e) =>  {
    setAllowed_consumption(e.target.value);
  }
  const handleallowCost = (e) =>  {
    setAllowedCost(e.target.value);
  }

  const handldeEndTime = (e) => {
    
  }

    return <MainContainer>
    <Container sx={{
        margin: '25px auto'
    }}>

        {/* <Title>Control Settings</Title> */}

        <div style={{ margin: '20px auto' }} />

        <h1>Elecitricity settings</h1>
        <Box component="form" noValidate onSubmit={handleSubmit} sx={{ mt: 1 }}>
        <TextField
                margin="normal"
                required
                fullWidth
                name="Allowed-consumption"
                label={'Allowed consumption'}
                type="text"
                id="password"
                min={0}
                autoComplete="Allowed-consumption"
            defaultValue={allowed_consumption}
            onChange={(e) => handleAllowChange(e)}
              />
          { 
            !allowedLoading ? 
            <Button type="submit" onClick={handleSubmit} variant="contained" autoFocus>
              Save Allowed consumption
            </Button> 
          :
          <CircularProgress color="secondary" />
          }

            </Box>

            <div style={{margin: '20px auto' }} />
          <Box component="form" noValidate onSubmit={handlecost} sx={{ mt: 1 }}>
          <TextField
            margin="normal"
            required
            fullWidth
            name="Allowed-consumption"
            label={'Allowed consumption'}
            type="text"
            id="password"
            min={0}
            autoComplete="Allowed-consumption"
            defaultValue={allowed_consumption}
            onChange={(e) => handleallowCost(e)}
          />
          {
            !costLoading ?
              <Button type="submit" onClick={handlecost} variant="contained" autoFocus>
                Save Allowed Cost
              </Button>
              :
              <CircularProgress color="secondary" />
          }

        </Box>

        <hr style={{margin: '30px auto'}} />

        <h1>Gas settings</h1>
        <Box component="form" noValidate onSubmit={handleSubmit} sx={{ mt: 1 }}>

        </Box>

        <div style={{ margin: '20px auto' }} />
        <Box component="form" noValidate onSubmit={handlecost} sx={{ mt: 1 }}>
          <TextField
            id="date"
            label="End-time"
            type="date"
            sx={{ width: 220 }}
            InputLabelProps={{
              shrink: true,
            }}
            onChange={(e) => handldeEndTime(e)}
          />

          <div style={{margin: '15px auto' }}></div>
          {
            !costLoading ?
              <Button type="submit" onClick={handlecost} variant="contained" autoFocus>
                Save cut time
              </Button>
              :
              <CircularProgress color="secondary" />
          }

        </Box>








        <hr style={{ margin: '30px auto' }} />

        <h1>Water settings</h1>
        <Box component="form" noValidate onSubmit={handleSubmit} sx={{ mt: 1 }}>

        </Box>

        <div style={{ margin: '20px auto' }} />
        <Box component="form" noValidate onSubmit={handlecost} sx={{ mt: 1 }}>
          <TextField
            id="date"
            label="End-time"
            type="date"
            sx={{ width: 220 }}
            InputLabelProps={{
              shrink: true,
            }}
            onChange={(e) => handldeEndTime(e)}
          />

          <div style={{ margin: '15px auto' }}></div>
          {
            !costLoading ?
              <Button type="submit" onClick={handlecost} variant="contained" autoFocus>
                Save cut time
              </Button>
              :
              <CircularProgress color="secondary" />
          }

        </Box>

    </Container>
  </MainContainer>
};