using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Solucao
    {
        public int Id { get; set; }
        [Required]
        public int PadraoId { get; set; }
        public Padrao Padrao { get; set; }
        [Required]
        public int SolventeId { get; set; }
        public Solvente Solvente { get; set; }
        [Required]
        public int EquipamentoId { get; set; }
        public Equipamento Equipamento { get; set; }
        [Required]
        public int UnidadeId { get; set; }
        public Unidade Unidade { get; set; }
        [Required]
        public double Volume { get; set; }
        public DateTime Create_at { get; set; }
        [Required]
        public DateTime Validade { get; set; }
        public DateTime Delete_at { get; set; }
    }
}
