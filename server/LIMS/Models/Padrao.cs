using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Padrao
    {
        public int Id { get; set; }
        [Required]
        public string Nome { get; set; }
        [Required]
        public double Volume { get; set; }
        [Required]
        public int UnidadeId { get; set; }
        public Unidade Unidade { get; set; }
        [Required]
        public decimal Valor { get; set; }
        [Required]
        public string NotaFiscal { get; set; }
        public DateTime Create_at { get; set; }
        [Required]
        public DateTime Validade { get; set; }
        public DateTime Delete_at { get; set; }
    }
}
