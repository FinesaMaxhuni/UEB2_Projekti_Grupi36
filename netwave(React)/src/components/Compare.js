import React from "react";
import { Container, Typography, Table, TableHead, TableRow, TableCell, TableBody } from "@mui/material";

function Compare() {
  const rows = [
    ["Shpejtësia mesatare", "100 Mbps", "1 Gbps+"],
    ["Latenca", "50 ms", "1–5 ms"],
    ["Kapaciteti i rrjetit", "Mesatar", "Shumë i lartë"],
    ["Mbështetja për pajisje", "Derivon", "Mijëra pajisje për antenë"],
    ["Përdorimi për AR/VR & IoT", "I kufizuar", "I plotë"],
  ];

  return (
    <Container sx={{ textAlign: "center", py: 10 }}>
      <Typography variant="h4" fontWeight={800} gutterBottom>
        5G vs 4G
      </Typography>
      <Table sx={{ maxWidth: 900, margin: "0 auto", border: "1px solid #e5e7eb" }}>
        <TableHead>
          <TableRow>
            <TableCell><b>Karakteristika</b></TableCell>
            <TableCell><b>4G</b></TableCell>
            <TableCell><b>5G</b></TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {rows.map((row, i) => (
            <TableRow key={i}>
              <TableCell>{row[0]}</TableCell>
              <TableCell>{row[1]}</TableCell>
              <TableCell>{row[2]}</TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </Container>
  );
}

export default Compare;
