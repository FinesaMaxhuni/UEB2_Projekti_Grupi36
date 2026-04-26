import React from "react";
import { Box, Grid, Card, CardContent, Typography, Button } from "@mui/material";

const plans = [
  {
    name: "5G Basic",
    price: "24.90 €/muaj",
    features: ["Shpejtësi deri në 150 Mbps", "Instalim falas", "Router 5G përfshirë"],
  },
  {
    name: "5G Plus",
    price: "34.90 €/muaj",
    features: ["Shpejtësi deri në 500 Mbps", "Pa kufizime në përdorim", "Router Wi-Fi 6"],
  },
  {
    name: "5G Premium",
    price: "49.90 €/muaj",
    features: ["Shpejtësi mbi 1 Gbps", "Prioritet në rrjet 5G", "Suport teknik 24/7"],
  },
];

const Plans = () => (
  <Box
    id="planet5g"
    sx={{
      background: "linear-gradient(135deg, #0a1929, #0f172a)",
      color: "white",
      py: 8,
      textAlign: "center",
    }}
  >
    <Typography variant="h4" fontWeight="bold" mb={5}>
      Zgjidh planin tënd 5G
    </Typography>
    <Grid container spacing={3} justifyContent="center">
      {plans.map((plan) => (
        <Grid item xs={12} sm={6} md={4} key={plan.name}>
          <Card
            sx={{
              background: "rgba(255,255,255,0.05)",
              border: "1px solid rgba(255,255,255,0.1)",
              borderRadius: 3,
              "&:hover": {
                borderColor: "#60a5fa",
                transform: "translateY(-6px)",
              },
              transition: "0.3s",
            }}
          >
            <CardContent>
              <Typography variant="h6" color="#60a5fa" gutterBottom>
                {plan.name}
              </Typography>
              <Typography variant="h5" fontWeight="bold" color="#60a5fa">
                {plan.price}
              </Typography>
              <ul style={{ textAlign: "left", color: "#fff", marginTop: "10px" }}>
                {plan.features.map((f) => (
                  <li key={f}>{f}</li>
                ))}
              </ul>
              <Button
                href="abonohu.html"
                variant="contained"
                sx={{ mt: 2, backgroundColor: "#60a5fa" }}
              >
                Abonohu
              </Button>
            </CardContent>
          </Card>
        </Grid>
      ))}
    </Grid>
  </Box>
);

export default Plans;
