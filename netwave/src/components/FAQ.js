import React from "react";
import { Accordion, AccordionSummary, AccordionDetails, Typography, Container } from "@mui/material";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";

function FAQ() {
  const questions = [
    { q: "Çfarë është 5G dhe si ndryshon nga 4G?", a: "5G është gjenerata më e re e rrjeteve mobile që ofron shpejtësi shumë më të lartë, latencë minimale dhe mbulim më të mirë në çdo zonë." },
    { q: "A mund të përdor routerin tim ekzistues?", a: "Jo, për rrjetin 5G përdoret një router i ri që mbështet teknologjinë 5G." },
    { q: "A ka kufizime në shpejtësi apo sasi të të dhënave?", a: "Jo, të gjitha planet tona 5G ofrojnë përdorim të pakufizuar." },
    { q: "A funksionon 5G edhe në zonat rurale?", a: "Po, rrjeti NetWave 5G mbulon shumicën e zonave urbane dhe rurale me sinjal të qëndrueshëm." },
    { q: "A ofroni instalim falas për routerin 5G?", a: "Po, instalimi fillestar është falas për çdo përdorues të ri." },
    { q: "Si mund të kontrolloj nëse 5G është i disponueshëm në zonën time?", a: "Mund ta kontrollosh mbulimin përmes hartës interaktive në faqen tonë kryesore." },
  ];

  return (
    <Container sx={{ py: 10 }}>
      <Typography variant="h4" textAlign="center" fontWeight={800} gutterBottom>
        Pyetje të shpeshta
      </Typography>
      {questions.map((item, i) => (
        <Accordion key={i} sx={{ mb: 2 }}>
          <AccordionSummary expandIcon={<ExpandMoreIcon />}>
            <Typography fontWeight={600}>{item.q}</Typography>
          </AccordionSummary>
          <AccordionDetails>
            <Typography>{item.a}</Typography>
          </AccordionDetails>
        </Accordion>
      ))}
    </Container>
  );
}

export default FAQ;
