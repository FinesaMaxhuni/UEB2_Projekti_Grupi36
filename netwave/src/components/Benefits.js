import React from "react";
import { Container, Grid, Typography } from "@mui/material";
import SpeedIcon from "@mui/icons-material/Speed";
import WifiIcon from "@mui/icons-material/Wifi";
import SupportAgentIcon from "@mui/icons-material/SupportAgent";

function Benefits() {
  const items = [
    { icon: <SpeedIcon fontSize="large" color="primary" />, title: "Shpejtësi ekstreme", text: "Arrin deri në 10x më shumë shpejtësi krahasuar me rrjetet tradicionale." },
    { icon: <WifiIcon fontSize="large" color="primary" />, title: "Lidhje stabile", text: "Mbulo territorin urban dhe rural me valë 5G të fuqishme." },
    { icon: <SupportAgentIcon fontSize="large" color="primary" />, title: "Suport 24/7", text: "Ekipi ynë teknik është gjithmonë aktiv për ndihmë dhe instalim." },
  ];

  return (
    <div style={{ background: "linear-gradient(135deg, #0a1929, #1a2845)", color: "white", textAlign: "center", padding: "80px 0" }}>
      <Container>
        <Typography variant="h4" fontWeight={800} gutterBottom>
          Pse të zgjedhësh NetWave 5G?
        </Typography>
        <Grid container spacing={4} justifyContent="center">
          {items.map((item, i) => (
            <Grid item xs={12} sm={6} md={4} key={i}>
              <div>{item.icon}</div>
              <Typography variant="h6" sx={{ color: "#60a5fa", mt: 2 }}>
                {item.title}
              </Typography>
              <Typography variant="body1" color="rgba(255,255,255,0.8)">
                {item.text}
              </Typography>
            </Grid>
          ))}
        </Grid>
      </Container>
    </div>
  );
}

export default Benefits;

