import React, { useState } from 'react';
import { Box, Button, Card, Modal, TextField, Typography } from '@mui/material';
import { getSession } from 'next-auth/react';

export const getServerSideProps = async (context) => {
  const session = await getSession(context);

  if (!session) {
    return {
      redirect: {
        destination: '/api/auth/signin',
        permanent: false,
      },
    };
  }

  return {
    props: {
      user: session.user,
    },
  };
};

const Home = (props) => {
  const [newAmountModalOpen, setNewAmountModalOpen] = useState(false);
  const [settingsModalOpen, setSettingsModalOpen] = useState(false);
  const [totalBalance, setTotalBalance] = useState(props.user.totalBalance);
  const [newTotalBalance, setNewTotalBalance] = useState(null);
  const [currentBalance, setCurrentBalance] = useState(
    props.user.currentBalance
  );
  const [dailyAllowance, setDailyAllowance] = useState(
    props.user.dailyAllowance
  );
  const [newAmount, setNewAmount] = useState(null);

  return (
    <div style={{ marginTop: '25px' }}>
      <Modal
        open={newAmountModalOpen}
        onClose={() => {
          setNewAmountModalOpen(false);
        }}
      >
        <Box
          sx={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            width: 400,
            bgcolor: 'background.paper',
            borderRadius: '25px',
            boxShadow: 24,
            p: 4,
          }}
        >
          <Typography variant="h4">Enter amount spent</Typography>
          <div
            style={{
              display: 'flex',
              justifyContent: 'space-between',
              marginTop: '10px',
            }}
          >
            <TextField
              variant="outlined"
              label="Amount"
              type="number"
              value={newAmount}
              onChange={(e) => {
                setNewAmount(e.target.value);
              }}
            />
            <Button
              variant="contained"
              onClick={async () => {
                const res = await fetch('https://allowance.rileygrotenhuis.com/api/balance', {
                  method: 'POST',
                  headers: {
                    Authorization: `Bearer ${props.user.id}`,
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                    amount: newAmount,
                  }),
                });

                const data = await res.json();

                setCurrentBalance(data.currentBalance);
                setDailyAllowance(data.dailyAllowance);
                setTotalBalance(data.totalBalance);
                setNewAmount(null);
                setNewAmountModalOpen(false);
              }}
            >
              Submit
            </Button>
          </div>
        </Box>
      </Modal>
      <Modal
        open={settingsModalOpen}
        onClose={() => {
          setSettingsModalOpen(false);
        }}
      >
        <Box
          sx={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            width: 400,
            bgcolor: 'background.paper',
            borderRadius: '25px',
            boxShadow: 24,
            p: 4,
          }}
        >
          <Typography variant="h5">Change Total Balance</Typography>
          <div
            style={{
              display: 'flex',
              justifyContent: 'space-between',
              marginTop: '10px',
            }}
          >
            <TextField
              variant="outlined"
              label="Total"
              type="number"
              value={newTotalBalance}
              onChange={(e) => {
                setNewTotalBalance(e.target.value);
              }}
            />
            <Button
              variant="contained"
              onClick={async () => {
                const res = await fetch('https://allowance.rileygrotenhuis.com/api/total', {
                  method: 'PUT',
                  headers: {
                    Authorization: `Bearer ${props.user.id}`,
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                    amount: newTotalBalance,
                  }),
                });

                const data = await res.json();

                setTotalBalance(data.totalBalance);
                setNewTotalBalance(null);
                setSettingsModalOpen(false);
              }}
            >
              Submit
            </Button>
          </div>
          <Typography variant="h5">Change Daily Allowance</Typography>
          <div
            style={{
              display: 'flex',
              justifyContent: 'space-between',
              marginTop: '10px',
            }}
          >
            <TextField
              variant="outlined"
              label="Amount"
              type="number"
              value={dailyAllowance}
              onChange={(e) => {
                setDailyAllowance(e.target.value);
              }}
            />
            <Button
              variant="contained"
              onClick={async () => {
                const res = await fetch('https://allowance.rileygrotenhuis.com/api/allowance', {
                  method: 'PUT',
                  headers: {
                    Authorization: `Bearer ${props.user.id}`,
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                    amount: dailyAllowance,
                  }),
                });

                const data = await res.json();

                setDailyAllowance(data.dailyAllowance);
                setCurrentBalance(data.currentBalance);
                setSettingsModalOpen(false);
              }}
            >
              Submit
            </Button>
          </div>
          <div
            style={{
              display: 'flex',
              justifyContent: 'center',
              marginTop: '25px',
            }}
          >
            <Button
              variant="contained"
              color="error"
              onClick={async () => {
                const res = await fetch('https://allowance.rileygrotenhuis.com/api/balance', {
                  method: 'PUT',
                  headers: {
                    Authorization: `Bearer ${props.user.id}`,
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                    amount: dailyAllowance,
                  }),
                });

                const data = await res.json();

                setCurrentBalance(data.currentBalance);
                setDailyAllowance(data.dailyAllowance);
                setSettingsModalOpen(false);
              }}
            >
              Reset Balance
            </Button>
          </div>
        </Box>
      </Modal>
      <Button
        style={{
          display: 'flex',
          margin: 'auto',
        }}
        onClick={() => {
          setNewAmountModalOpen(true);
        }}
      >
        <Card
          style={{
            width: '350px',
            height: '300px',
            borderRadius: '25px',
            display: 'flex',
            flexDirection: 'column',
            justifyContent: 'center',
            alignItems: 'center',
          }}
        >
          <Typography variant="h3">${currentBalance.toFixed(2)}</Typography>
          <Typography
            variant="subtitle1"
            style={{
              fontWeight: 'lighter',
            }}
          >
            (${totalBalance.toFixed(2)})
          </Typography>
        </Card>
      </Button>
      <div
        style={{
          display: 'flex',
          width: '250px',
          margin: 'auto',
          justifyContent: 'center',
          marginTop: '10px',
        }}
      >
        <Button
          variant="contained"
          color="primary"
          style={{
            margin: 'auto',
          }}
          onClick={() => {
            setSettingsModalOpen(true);
          }}
        >
          Settings
        </Button>
        <Button
          variant="contained"
          color="success"
          style={{
            margin: 'auto',
          }}
          onClick={async () => {
            const res = await fetch('https://allowance.rileygrotenhuis.com/api/day', {
              method: 'POST',
              headers: {
                Authorization: `Bearer ${props.user.id}`,
                'Content-Type': 'application/json',
              },
            });

            const data = await res.json();

            setCurrentBalance(data.currentBalance);
          }}
        >
          New Day
        </Button>
      </div>
    </div>
  );
};

export default Home;
